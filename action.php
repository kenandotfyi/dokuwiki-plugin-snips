<?php

if (!defined('DOKU_INC')) die();

/** Adds configured snippets to DokuWiki's editor toolbar. */
class action_plugin_snips extends DokuWiki_Action_Plugin
{
    public function register(Doku_Event_Handler $controller)
    {
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'addToolbarPicker');
        $controller->register_hook('JS_CACHE_USE', 'BEFORE', $this, 'addSnippetsCacheDependency');
    }

    /**
     * Toolbar definitions are part of DokuWiki's combined JavaScript cache.
     * Make snippet settings a dependency so saving them rebuilds that bundle.
     */
    public function addSnippetsCacheDependency(Doku_Event $event, $param)
    {
        $cache = $event->data;
        if (!is_object($cache) || !isset($cache->key, $cache->depends)) return;
        if (strpos($cache->key, 'scripts') !== 0) return;

        $cache->depends['files'][] = DOKU_CONF . 'plugin/snips/snippets.json';
    }

    public function addToolbarPicker(Doku_Event $event, $param)
    {
        /** @var helper_plugin_snips|null $helper */
        $helper = plugin_load('helper', 'snips');
        if (!$helper) return;

        $items = [];
        foreach ($helper->getSnippets() as $snippet) {
            if (empty($snippet['enabled'])) continue;
            $item = [
                'title' => $snippet['label'],
                'icon' => $snippet['icon'] === '' ? '' : $helper->getToolbarIconPath($snippet['icon']),
                'mode' => $snippet['mode'],
            ];
            if ($snippet['mode'] === 'wrap') {
                $item['open'] = $snippet['open'];
                $item['close'] = $snippet['close'];
            } else {
                $item['insert'] = $snippet['insert'];
            }
            $items[] = $item;
        }
        if (!$items) return;

        $event->data[] = [
            'type' => 'snips',
            'title' => $this->getLang('toolbar_title'),
            'icon' => '../../plugins/snips/images/snips.svg',
            'list' => $items,
        ];
    }
}
