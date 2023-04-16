<?php


/**
 * Class HtmlList
 * @author Rafael Velosa
 */
class HtmlList{
    /**
     * Guarda a informação
     * @var array $dados
     */
    private array $dados;

    /**
     * Guarda as classes
     * @var array
     */
    private array $classes;

    /**
     * Guarda o id
     * @var string
     */
    private string $id;

    /**
     * Guarda a tag da lista
     * @var string
     */
    private string $tag;

    /**
     * HtmlList constructor.
     * @param $dados
     * @param bool $ordered
     * @param array $classes
     * @param string $id
     */
    public function __construct($dados, $ordered=true, $classes=[], $id=""){
        $this->dados = $dados;
        $this->ordered = $ordered;
        $this->classes = $classes;
        $this->id = $id;
        $this->tag = $ordered ? "ol" : "ul";
        return $this;
    }

    /**
     * Adiciona uma class
     * @param $class
     * @return $this
     */
    public function addClass($class){
        if (in_array($class, $this->classes)) return $this;
        $this->classes[] = $class;
        return $this;
    }

    /**
     * retira uma class
     * @param $class
     * @return $this
     */
    public function removeClass($class){
        if (!in_array($class, $this->classes)) return $this;
        $this->classes = array_diff($this->classes, [$class]);
        return $this;
    }

    /**
     * Set id
     * @param $id
     * @return $this
     */
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * Unset id
     * @param $id
     * @return $this
     */
    public function unsetId($id){
        $this->id = "";
        return $this;
    }

    /**
     * Retorna o html
     * @param $action
     * @return string
     */
    public function getHtml($action=null){
        $classes = implode(' ', $this->classes);
        $dados = $this->dados;
        if ($action != null){
            $dados=iterate($this->dados, $action);
        }
        return <<<HTML
                <$this->tag class="$classes" id="$this->id">
                    $dados
                <$this->tag/>                    
                HTML;
    }
}