# Snips

Snips adds a configurable picker to the DokuWiki editor toolbar. Manage entries in **Admin → Snips**. Entries with an icon show that icon in the picker; entries without one show their label as text.

Each entry can either insert text at the cursor or wrap selected text with opening and closing text. Entries can be enabled, reordered, and assigned an icon.

When the Tag plugin is installed, the Snips dropdown includes a searchable **Existing tags** section above the saved snippets. Select one or more tags and choose **Insert selected tags** to add them in one `{{tag>name another-name}}` macro. The picker also keeps an **Insert tag syntax…** option for adding a new tag manually. The tag list is fetched when the picker opens, so it follows the current tag index without exposing user-specific tag visibility in a shared JavaScript cache. The Tag plugin's own syntax toolbar button remains unchanged.

Snippet definitions are stored per wiki at `conf/plugin/snips/snippets.json`, outside the plugin directory, so plugin updates do not replace them. Custom icon files can be uploaded with DokuWiki's Media Manager; enter their media ID in the icon field, for example `wiki:snips:icons:info.svg`.

Back up the `conf/plugin/snips/` folder and the media namespace holding your custom icons along with the rest of the wiki data.
