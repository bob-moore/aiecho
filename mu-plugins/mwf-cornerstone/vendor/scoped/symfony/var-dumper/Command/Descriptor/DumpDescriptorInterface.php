<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Command\Descriptor;

use Mwf\Cornerstone\Deps\Symfony\Component\Console\Output\OutputInterface;
use Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Cloner\Data;
/**
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 * @internal
 */
interface DumpDescriptorInterface
{
    public function describe(OutputInterface $output, Data $data, array $context, int $clientId) : void;
}
