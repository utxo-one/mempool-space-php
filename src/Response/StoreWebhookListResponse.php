<?php

declare(strict_types=1);

namespace MempoolSpace\Response;

class StoreWebhookListResponse extends AbstractListResponse
{
    /**
     * @return StoreWebhookResponse[]
     */
    public function all(): array
    {
        $webhooks = [];
        foreach ($this->getData() as $webhook) {
            $webhooks[] = new StoreWebhookResponse(['data' => $webhook]);
        }
        return $webhooks;
    }

    /**
     * @return StoreWebhookResponse[]
     */
    public function getWebhooksByStatus(string $status): array
    {
        $r = array_filter(
            $this->all(),
            function (StoreWebhookResponse $webhook) use ($status) {
                return $webhook->getStatus() === $status;
            }
        );

        // Renumber results
        return array_values($r);
    }
}
