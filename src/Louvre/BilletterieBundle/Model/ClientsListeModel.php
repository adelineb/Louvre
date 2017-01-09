<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04/01/2017
 * Time: 16:46
 */

namespace Louvre\BilletterieBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Louvre\BilletterieBundle\Model\ClientModel;


class ClientsListeModel
{
    /**
     * @var \string
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
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