<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phung Le
 * Date: 11/24/2021
 * Time: 12:00 PM.
 */

namespace App\Transformers;

use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\ArraySerializer;

class DataArraySerializer extends ArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param  string  $resourceKey
     * @param  array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data): array
    {
        return $resourceKey ? [$resourceKey => $data] : $data;
    }

    /**
     * Serialize an item.
     *
     * @param  string  $resourceKey
     * @param  array  $data
     *
     * @return array
     */
    public function item($resourceKey, array $data): array
    {
        return $data;
    }

    /**
     * Serialize null resource.
     *
     * @return ?array
     */
    public function null(): ?array
    {
        return null;
    }

    /**
     * Serialize the meta.
     *
     * @param  array  $meta
     *
     * @return array
     */
    public function meta(array $meta): array
    {
        if (empty($meta)) {
            return [];
        }

        return $meta['pagination'] ?? $meta;
    }

    /**
     * Serialize the paginator.
     *
     * @param  PaginatorInterface  $paginator
     *
     * @return array
     */
    public function paginator(PaginatorInterface $paginator): array
    {
        if ($paginator instanceof IlluminatePaginatorAdapter) {
            $data = [
                'total' => $paginator->getTotal() !== IlluminatePaginatorAdapter::INT_NULL
                    ? $paginator->getTotal() : null,
                'count' => $paginator->getCount(),
                'per_page' => $paginator->getPerPage(),
                'current_page' => $paginator->getCurrentPage(),
                'last_page' => $paginator->getLastPage() !== IlluminatePaginatorAdapter::INT_NULL
                    ? $paginator->getLastPage() : null,
                'has_more' => $paginator->getHasMorePages(),
            ];
        } else {
            $data = parent::paginator($paginator)['pagination'];
        }

        return ['pagination' => $data];
    }
}
