<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phung Le
 * Date: 11/25/2021
 * Time: 7:57 PM.
 */

namespace App\Transformers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use League\Fractal\Pagination\PaginatorInterface;

class IlluminatePaginatorAdapter implements PaginatorInterface
{
    public const INT_NULL = -1;

    /**
     * The paginator instance.
     *
     * @var Paginator|LengthAwarePaginator
     */
    protected Paginator|LengthAwarePaginator $paginator;

    /**
     * Create a new illuminate pagination adapter.
     *
     * @param  Paginator|LengthAwarePaginator  $paginator
     *
     * @return void
     */
    public function __construct(Paginator|LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentPage(): int
    {
        return $this->paginator->currentPage();
    }

    /**
     * @inheritDoc
     */
    public function getLastPage(): ?int
    {
        if ($this->getPaginator() instanceof Paginator) {
            return self::INT_NULL;
        }

        return $this->paginator->lastPage();
    }

    /**
     * @inheritDoc
     */
    public function getTotal(): int
    {
        if ($this->getPaginator() instanceof Paginator) {
            return self::INT_NULL;
        }

        return $this->paginator->total();
    }

    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        return $this->paginator->count();
    }

    /**
     * @inheritDoc
     */
    public function getPerPage(): int
    {
        return $this->paginator->perPage();
    }

    /**
     * @inheritDoc
     */
    public function getUrl($page): string
    {
        return $this->paginator->url($page);
    }

    /**
     * Determine if there are more items in the data source.
     *
     * @return bool
     */
    public function getHasMorePages(): bool
    {
        return $this->paginator->hasMorePages();
    }

    /**
     * Get the paginator instance.
     *
     * @return Paginator|LengthAwarePaginator
     */
    public function getPaginator(): Paginator|LengthAwarePaginator
    {
        return $this->paginator;
    }
}
