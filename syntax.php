<?php

class syntax_plugin_anchor extends DokuWiki_Syntax_Plugin {

    CONST PREG_PATTERN = "/^\{\{anchor:(.*):(.*)}}$/ui";

    const DATA_COUNT = 3;

    function getType() {
        return 'substition';
    }

    function getPType() {
        return 'normal';
    }

    function getSort() {
        return 167;
    }

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('\{\{anchor:[^}]*\}\}', $mode, 'plugin_anchor');
    }

    function handle($match, $state, $pos, Doku_Handler $handler) {
        preg_match(self::PREG_PATTERN, $match, $result);
        return $result;
    }

    function render($format, Doku_Renderer $renderer, $data) {
        if(count($data) != self::DATA_COUNT) {
            $renderer->doc .= "|| ERROR (plugin anchor) :: Bad content!<br>";
            $renderer->doc .= "|| Usage: {{anchor:tag:content}}<br>";
            return;
        }
        list(/* $raw */, $id, $content) = $data;
        $renderer->doc .= '<a id="' . $id. '">' . $content . '</a>';
    }
}
