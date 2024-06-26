<?php

namespace Mwf\Cornerstone\Deps\Timber\Cache;

use Mwf\Cornerstone\Deps\Timber\Loader;
/** @internal */
class WPObjectCacheAdapter
{
    private $cache_group;
    /**
     * @var \Timber\Loader
     */
    private $timberloader;
    public function __construct(Loader $timberloader, $cache_group = 'timber')
    {
        $this->cache_group = $cache_group;
        $this->timberloader = $timberloader;
    }
    public function fetch($key)
    {
        return $this->timberloader->get_cache($key, $this->cache_group, Loader::CACHE_USE_DEFAULT);
    }
    public function save($key, $value, $expire = 0)
    {
        return $this->timberloader->set_cache($key, $value, $this->cache_group, $expire, Loader::CACHE_USE_DEFAULT);
    }
}
