<?php

namespace App\Session;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Container\Container;
use SessionHandlerInterface;

class CustomDatabaseSessionHandler implements SessionHandlerInterface
{
    protected $connection;
    protected $table;
    protected $lifetime;
    protected $container;
    protected $exists = false;

    public function __construct(ConnectionInterface $connection, $table, $lifetime, Container $container = null)
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->lifetime = $lifetime;
        $this->container = $container;
    }

    public function open($savePath, $sessionName): bool
    {
        return true;
    }

    public function close(): bool
    {
        return true;
    }
    public function read($sessionId): string|false
    {
        $session = $this->getQuery()->where('id_232136', $sessionId)->first();

        if ($session) {
            $this->exists = true;
            return base64_decode($session->payload_232136);
        }

        return '';
    }

    public function touch($sessionId, $data): bool
    {
        return $this->getQuery()->where('id_232136', $sessionId)->update([
            'last_activity_232136' => $this->currentTime(),
        ]);
    }

    public function write($sessionId, $data): bool
    {
        $payload = $this->getDefaultPayload($data);

        if (! $this->exists) {
            $this->read($sessionId);
        }

        if ($this->exists) {
            $this->performUpdate($sessionId, $payload);
        } else {
            $this->performInsert($sessionId, $payload);
        }

        return $this->exists = true;
    }

    protected function performInsert($sessionId, $payload)
    {
        try {
            return $this->getQuery()->insert([
                'id_232136' => $sessionId,
                'user_id_232136' => $payload['user_id_232136'],
                'ip_address_232136' => $payload['ip_address_232136'],
                'user_agent_232136' => $payload['user_agent_232136'],
                'payload_232136' => $payload['payload_232136'],
                'last_activity_232136' => $payload['last_activity_232136'],
            ]);
        } catch (\Exception $e) {
            $this->performUpdate($sessionId, $payload);
        }
    }

    protected function performUpdate($sessionId, $payload)
    {
        return $this->getQuery()->where('id_232136', $sessionId)->update($payload);
    }

    protected function getDefaultPayload($data)
    {
        $payload = [
            'payload_232136' => base64_encode($data),
            'last_activity_232136' => $this->currentTime(),
            'user_id_232136' => null,
            'ip_address_232136' => request()->ip(),
            'user_agent_232136' => substr((string) request()->header('User-Agent'), 0, 500),
        ];

        if (! $this->container) {
            return $payload;
        }

        return tap($payload, function (&$payload) {
            $this->addUserInformation($payload);
        });
    }

    protected function addUserInformation(&$payload)
    {
        if ($this->container && $this->container->bound(Guard::class)) {
            $guard = $this->container->make(Guard::class);
            $payload['user_id_232136'] = $guard->user() ? $guard->user()->getAuthIdentifier() : null;
        }
    }

    public function destroy($sessionId): bool
    {
        $this->getQuery()->where('id_232136', $sessionId)->delete();
        return true;
    }

    public function gc($lifetime): int|false
    {
        return $this->getQuery()
            ->where('last_activity_232136', '<=', $this->currentTime() - $lifetime)
            ->delete();
    }

    protected function getQuery()
    {
        return $this->connection->table($this->table);
    }

    protected function currentTime()
    {
        return time();
    }
}