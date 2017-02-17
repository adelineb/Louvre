<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04/01/2017
 * Time: 16:46
 */

namespace Louvre\BilletterieBundle\Model;

class ClientsListeModel
{
    /**
     * @var \string
     */
    public $clients;

    public function __construct(array $clients)
    {
        $this->clients = $clients;
    }

    public function addClients(ClientModel $client)
    {
        $this->clients[] = $client;
    }

    public function removeClients(ClientModel $client)
    {
        $this->clients->removeElement($client);
    }

    public function getClients()
    {
        return $this->clients;
    }
}