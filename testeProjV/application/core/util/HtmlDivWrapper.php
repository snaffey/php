<?php


/**
 * Class HtmlDivWrapper
 * @author Rafael Velosa
 */
class HtmlDivWrapper{

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
     * HtmlDivWrapper constructor.
     * @param $dados
     * @param array $classes
     * @param string $id
     */
    public function __construct($dados, $classes=[], $id=""){
        $this->dados = $dados;
        $classes[] = "wrapper";
        $this->classes = $classes;
        $this->id = $id;
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
            $dados = implode(' ', $dados);
        }

        return <<<HTML
                <div class="$classes" id="$this->id">
                    $dados
                <div/>                    
                HTML;
    }
}