<?php

/*
 * DirectAdmin API Client
 * (c) Omines Internetbureau B.V. - https://omines.nl/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omines\DirectAdmin\Context;

use Omines\DirectAdmin\DirectAdmin;

/**
 * Encapsulates a contextual connection to a DirectAdmin server.
 *
 * @author Niels Keurentjes <niels.keurentjes@omines.com>
 */
abstract class BaseContext
{
    /** @var DirectAdmin */
    private $connection;

    /**
     * Constructs the object.
     *
     * @param DirectAdmin $connection A prepared connection
     */
    public function __construct(DirectAdmin $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Returns the internal connection wrapper.
     *
     * @return DirectAdmin
     */
    protected function getConnection()
    {
        return $this->connection;
    }

    /**
     * Invokes the DirectAdmin API via HTTP GET.
     *
     * @param string $command DirectAdmin API command to invoke
     * @param array $query Optional query parameters
     * @return array The parsed and validated response
     */
    public function invokeGet($command, $query = [])
    {
        return $this->connection->invoke('GET', $command, ['query' => $query]);
    }

    /**
     * Invokes the DirectAdmin API via HTTP POST.
     *
     * @param string $command DirectAdmin API command to invoke
     * @param array $postParameters Optional form parameters
     * @return array The parsed and validated response
     */
    public function invokePost($command, $postParameters = [])
    {
        return $this->connection->invoke('POST', $command, ['form_params' => $postParameters]);
    }

    /**
     * Invokes the DirectAdmin API via HTTP GET using a custom command.
     * This command should include the 'CMD_' part.
     *
     * @param string $command Full DirectAdmin command to invoke
     * @param array $query Optional query parameters
     * @return array The parsed and validated response
     */
    public function invokeCustomGet($command, $query = [])
    {
        return $this->connection->invokeCustom('GET', $command, ['query' => $query]);
    }

    /**
     * Invokes the DirectAdmin API via HTTP POST using a custom command.
     * This command should include the 'CMD_' part.
     *
     * @param string $command Full DirectAdmin command to invoke
     * @param array $postParameters Optional form parameters
     * @return array The parsed and validated response
     */
    public function invokeCustomPost($command, $postParameters = [])
    {
        return $this->connection->invokeCustom('POST', $command, ['form_params' => $postParameters]);
    }
}
