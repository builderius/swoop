<?php

namespace Swoop\Bundle\KernelBundle\Provider;

class PluginsVersionsProvider
{
    private array $pluginsVersions = [];

    public function __construct(private array $plugins)
    {
    }

    public function getPluginsVersions(): array
    {
        if (empty($this->pluginsVersions)) {
            if (!function_exists('get_plugin_data')) {
                require_once(
                sprintf('%1$swp-admin%2$sincludes%2$splugin.php', ABSPATH, DIRECTORY_SEPARATOR)
                );
            }
            foreach ($this->plugins as $plugin) {
                $data = get_plugin_data(sprintf('%s%s%s', WP_PLUGIN_DIR, DIRECTORY_SEPARATOR, $plugin), false, false);
                $this->pluginsVersions[$plugin] = $data['Version'];
                $this->pluginsVersions[explode('/', $plugin)[0]] = $data['Version'];
            }
        }

        return $this->pluginsVersions;
    }

    public function getPluginVersion(string $plugin): ?string
    {
        $pluginsVersions = $this->getPluginsVersions();
        if (isset($pluginsVersions[$plugin])) {
            return $pluginsVersions[$plugin];
        }

        return null;
    }
}