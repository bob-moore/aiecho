<?php

namespace Mwf\ChildTheme\Deps\Timber;

/**
 * Interface Setupable
 * @internal
 */
interface Setupable
{
    /**
     * Sets up an object.
     *
     * @since 2.0.0
     *
     * @return Core The affected object.
     */
    public function setup();
    /**
     * Resets variables after the loop.
     *
     * @since 2.0.0
     *
     * @return Core The affected object.
     */
    public function teardown();
}
