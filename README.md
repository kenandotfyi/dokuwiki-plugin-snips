# Snips

Snips adds a configurable picker to the DokuWiki editor toolbar. Manage entries in **Admin → Snips**. Entries with an icon show that icon in the picker; entries without one show their label as text.

Each entry can either insert text at the cursor or wrap selected text with opening and closing text. Entries can be enabled, reordered, and assigned an icon.

Snippet definitions are stored per wiki at `conf/plugin/snips/snippets.json`, outside the plugin directory, so plugin updates do not replace them. Custom icon files can be uploaded with DokuWiki's Media Manager; enter their media ID in the icon field, for example `wiki:snips:icons:info.svg`.

Back up the `conf/plugin/snips/` folder and the media namespace holding your custom icons along with the rest of the wiki data.
