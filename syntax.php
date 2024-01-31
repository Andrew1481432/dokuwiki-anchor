<?php
class syntax_plugin_anchor extends DokuWiki_Syntax_Plugin {

    CONST PREG_PATTERN = "/^\{\{anchor:(.*):(.*)}}$/ui";

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
        list(/* $rawContent */, $id, $content) = $data; // blame php 5... I want use new syntax list [$rawContent, $id, $content]
		$renderer->doc .= '<a id="' . $id. '">' . $content . '</a>';
	}
}
