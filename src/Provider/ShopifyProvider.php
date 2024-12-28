<?php 
namespace OSW3\Shop\Provider;

use Shopify\Context;
use Shopify\Auth\Session;
use Shopify\Clients\Rest;
// use OSW3\Shop\Service\ShopifyService;
use OSW3\Shop\Storage\SessionStorage;
use OSW3\Shop\DependencyInjection\Configuration;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class ShopifyProvider
{
    private Rest $client;

    private const DOMAIN = '%s.myshopify.com';
    private array $params;
    private string $apiKey;
    private string $apiSecret;
    private string $apiVersion;
    private string $shopName;
    private array $scopes;
    private string $accessToken;

    public function __construct(
        #[Autowire(service: 'service_container')] private ContainerInterface $container,
        private HttpClientInterface $httpClient,
    )
    {
        $this->params      = $container->getParameter(Configuration::NAME);
        $this->apiKey      = $this->params['provider']['shopify']['api_key'];
        $this->apiSecret   = $this->params['provider']['shopify']['api_secret'];
        $this->shopName    = $this->params['provider']['shopify']['shop_name'];
        $this->accessToken = $this->params['provider']['shopify']['access_token'];
        $this->scopes      = $this->params['provider']['shopify']['scopes'];
        $this->apiVersion  = "2024-10";

        $this->client = $this->connect();
    }

    private function connect()
    {
        $hostName = sprintf(self::DOMAIN, $this->shopName);
        $sessionStorage = new SessionStorage(); 

        Context::initialize(
            $this->apiKey,
            $this->apiSecret,
            $this->scopes,
            $hostName,
            $sessionStorage,
            $this->apiVersion,
            // true,               // Application embarquée
            // false,              // Application privée
            // null,               // Pas de token privé pour l'instant
            // $userAgentPrefix,   // Préfixe du user-agent
            // new NullLogger(),   // Pas de logger pour l'instant
            // []                  // Aucun domaine personnalisé
        );

        $session = new Session(
            uniqid(),
            $hostName,
            true,
            uniqid()
        );

        return new Rest($session->getShop(), $this->accessToken);
    }
    
    protected function extractPageInfo(?string $linkHeader): ?string
    {
        if (!$linkHeader) {
            return null;
        }

        if (preg_match('/<.*page_info=([^&>]+).*>; rel="next"/', $linkHeader, $matches)) {
            return $matches[1];
        }

        return null;
    }

    protected function names(): array 
    {
        return [];
    }


    public function count(): int
    {
        $response = $this->client->get(sprintf('%s/count', $this->names()[0]));

        return $response->getDecodedBody()['count'] ?? 0;
    }
    
    public function all(): array
    {
        $results = [];
        $headers = [];
        $query = [];

        do {
            $response = $this->client->get($this->names()[0], $headers, $query);

            if ($response->getStatusCode() !== 200) {
                dd($response->getBody()->getContents());

                throw new \Exception(sprintf('Failed to fetch %s from Shopify', $this->names()[0]));
            }

            $data = $response->getDecodedBody()[$this->names()[0]] ?? [];
            $results = array_merge($results, $data);

            $linkHeader = $response->getHeaders(false)['link'][0] ?? null;
            $query['page_info'] = $this->extractPageInfo($linkHeader);

        } while (!empty($query['page_info']));

        return $results;
    }

    public function create()
    {
    }

    public function read(int $id): array
    {
        $response = $this->client->get(sprintf('%s/%s', $this->names()[0], $id));

        return $response->getDecodedBody()[$this->names()[1]] ?? [];
    }

    public function update(int $id)
    {
    }

    public function delete(int $id)
    {
    }


// GET /admin/api/{version}/products.json
// POST /admin/api/{version}/products.json
// PUT /admin/api/{version}/products/{product_id}.json
// DELETE /admin/api/{version}/products/{product_id}.json
// GET /admin/api/{version}/products/{product_id}.json

// 2. Collections (/collections)
// GET /admin/api/{version}/custom_collections.json
// POST /admin/api/{version}/custom_collections.json
// PUT /admin/api/{version}/custom_collections/{collection_id}.json
// DELETE /admin/api/{version}/custom_collections/{collection_id}.json

// 3. Commandes (/orders)
// Lister les commandes : GET /admin/api/{version}/orders.json
// Créer une commande : POST /admin/api/{version}/orders.json
// Mettre à jour une commande : PUT /admin/api/{version}/orders/{order_id}.json
// Supprimer une commande : DELETE /admin/api/{version}/orders/{order_id}.json
// Récupérer une commande par ID : GET /admin/api/{version}/orders/{order_id}.json

// 4. Clients (customers) (/customers)
// Lister les clients : GET /admin/api/{version}/customers.json
// Créer un client : POST /admin/api/{version}/customers.json
// Mettre à jour un client : PUT /admin/api/{version}/customers/{customer_id}.json
// Supprimer un client : DELETE /admin/api/{version}/customers/{customer_id}.json
// Récupérer un client par ID : GET /admin/api/{version}/customers/{customer_id}.json

// 5. Variantes de produits (/variants)
// Lister les variantes : GET /admin/api/{version}/variants.json
// Créer une variante : POST /admin/api/{version}/variants.json
// Mettre à jour une variante : PUT /admin/api/{version}/variants/{variant_id}.json
// Supprimer une variante : DELETE /admin/api/{version}/variants/{variant_id}.json

// 6. Collections de produits (/product_collections)
// Associer un produit à une collection : POST /admin/api/{version}/collects.json
// Lister les produits dans une collection spécifique : GET /admin/api/{version}/collects.json?collection_id={collection_id}

// 7. Inventaire (/inventory_items et /inventory_levels)
// Lister les éléments d'inventaire : GET /admin/api/{version}/inventory_items.json
// Mettre à jour les niveaux d'inventaire : POST /admin/api/{version}/inventory_levels/set.json

// 8. Paiements (/transactions)
// Lister les transactions de paiement : GET /admin/api/{version}/transactions.json
// Créer une transaction de paiement : POST /admin/api/{version}/transactions.json

// 9. Expéditions et livraisons (/fulfillments)
// Lister les expéditions : GET /admin/api/{version}/fulfillments.json
// Créer une expédition : POST /admin/api/{version}/fulfillments.json
// Mettre à jour une expédition : PUT /admin/api/{version}/fulfillments/{fulfillment_id}.json

// 10. Applications privées (/applications)
// Lister les applications installées : GET /admin/api/{version}/apps.json

// 11. Paiements récurrents et abonnements (/recurring_application_charges)
// Lister les charges d'application récurrentes : GET /admin/api/{version}/recurring_application_charges.json
// Créer une charge récurrente : POST /admin/api/{version}/recurring_application_charges.json

// 12. Webhooks
// Lister les webhooks : GET /admin/api/{version}/webhooks.json
// Créer un webhook : POST /admin/api/{version}/webhooks.json
// Supprimer un webhook : DELETE /admin/api/{version}/webhooks/{webhook_id}.json

// 13. Réductions et codes promo (/price_rules et /discount_codes)
// Lister les règles de prix (discounts) : GET /admin/api/{version}/price_rules.json
// Créer un code promo : POST /admin/api/{version}/discount_codes.json

// 14. Rapports (/reports)
// Lister les rapports : GET /admin/api/{version}/reports.json
// Créer un rapport personnalisé : POST /admin/api/{version}/reports.json

// 15. Analytique (/analytics)
// Accédez à des informations sur les performances de votre boutique en ligne, telles que les ventes, les visiteurs et d'autres métriques.

// 16. Files d'attente d'événements (/events)
// Permet de lister les événements dans la boutique.
}