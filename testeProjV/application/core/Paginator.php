<?php


class Paginator{
    protected int $totalItems;
    protected int $numPages;
    protected int $itemsPerPage;
    protected int $currentPage;
    protected stdClass $pageInfo;
    protected Db $db;

    /**
     * Paginator constructor.
     * @param $totalItems
     * @param $itemsPerPage
     * @param $currentPage
     */
    public function __construct($totalItems, $itemsPerPage, $currentPage){
        $this->db = new Db();
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;

        $this->updateNumPages();
        $this->setPageInfo();
    }

    /**
     * @return stdClass
     */
    public function getPageInfo(): stdClass
    {
        return $this->pageInfo;
    }

    protected function updateNumPages(){
        $this->numPages = ($this->itemsPerPage == 0 ? 0 : (int) ceil($this->totalItems/$this->itemsPerPage));
    }

    protected function setPageInfo(){
        $info = new stdClass();
        $info->hasNextPage = $this->currentPage +1 <= $this->numPages;
        $info->hasPreviousPage = $this->currentPage - 1 > 0;
        $info->pageNum = $this->currentPage;
        $info->offset = ($this->currentPage-1)*$this->itemsPerPage;
        $info->limit = $this->itemsPerPage;
        $info->show = $this->numPages > 0;
        $info->pageNum = $this->currentPage;
        $info->numPages = $this->numPages;
        $this->pageInfo = $info;
    }

    /**
     * @param string $query
     * o parametro query tem de ter 2 chaves para dar bind na base de dados a :offset :limit e tem de ser uma select query
     * @param array $args
     * @return array|null
     */
    public function getItens(string $query, array $args = []){
        if (!$this->pageInfo->show) return [];
        $query = str_replace(':limit',$this->pageInfo->limit,$query);
        $query = str_replace(':offset',$this->pageInfo->offset,$query);
        return $this->db->runQuery($args, query: $query);
    }

}