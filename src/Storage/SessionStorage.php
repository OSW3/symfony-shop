<?php 
namespace OSW3\Shop\Storage;

use Shopify\Auth\Session;
use Shopify\Auth\SessionStorage as ShopifySessionStorage;

class SessionStorage implements ShopifySessionStorage
{
    private array $sessions = [];

    public function storeSession(Session $session): bool
    {
        $this->sessions[$session->getId()] = $session;
        return true;
    }

    public function loadSession(string $sessionId)
    {
        return $this->sessions[$sessionId] ?? null;
    }

    public function deleteSession(string $sessionId): bool
    {
        if (isset($this->sessions[$sessionId])) {
            unset($this->sessions[$sessionId]);
            return true;
        }
        return false;
    }
}