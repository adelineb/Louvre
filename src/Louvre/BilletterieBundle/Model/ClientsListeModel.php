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
    private $Clients;

    public function addClient(ClientModel $client)
    {
        $this->Clients[] = $client;
    }

    public function removeClient(ClientModel $client)
    {
        $this->Clients->removeElement($client);
    }

    public function getClient()
    {
        return $this->Clients;
    }
}