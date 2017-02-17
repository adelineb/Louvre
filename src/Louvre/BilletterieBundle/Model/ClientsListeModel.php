<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04/01/2017
 * Time: 16:46
 */

namespace Louvre\BilletterieBundle\Model;

use Louvre\BilletterieBundle\Model\ClientModel;

class ClientsListeModel
{
    /**
     * @var \string
     */
    public $clients;

    //public function __construct(array $clients)
    public function __construct($nbClient)
    {
        //$this->clients = $clients;
        $tabClient = array();
        for($nb=1; $nb <= $nbClient; $nb++)
        {
            $tabClient[] = new ClientModel();
        }
        $this->clients = $tabClient;
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