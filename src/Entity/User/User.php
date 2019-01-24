<?php

declare(strict_types=1);

namespace App\Entity\User;

use App\Entity\Inventory\Container;
use App\Event\UserContainerAddedEvent;
use Doctrine\ORM\Mapping as ORM;
use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Entity\Features\CanBeConfirmed;
use MsgPhp\Domain\Entity\Features\CanBeEnabled;
use MsgPhp\Domain\Entity\Fields\CreatedAtField;
use MsgPhp\Domain\Event\DomainEventHandlerInterface;
use MsgPhp\Domain\Event\DomainEventHandlerTrait;
use MsgPhp\Domain\Factory\DomainCollectionFactory;
use MsgPhp\User\Entity\Credential\EmailPassword;
use MsgPhp\User\Entity\Features\EmailPasswordCredential;
use MsgPhp\User\Entity\Features\ResettablePassword;
use MsgPhp\User\Entity\Fields\AttributeValuesField;
use MsgPhp\User\Entity\Fields\EmailsField;
use MsgPhp\User\Entity\Fields\RolesField;
use MsgPhp\User\Entity\User as BaseUser;
use MsgPhp\User\UserIdInterface;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "premium_user" = "PremiumUser"})
 */
class User extends BaseUser implements DomainEventHandlerInterface
{
    use CreatedAtField;
    use EmailPasswordCredential;
    use ResettablePassword;
    use CanBeEnabled;
    use CanBeConfirmed;
    use EmailsField;
    use RolesField;
    use AttributeValuesField;
    use DomainEventHandlerTrait;

    /** @ORM\Id() @ORM\Column(type="msgphp_user_id", length=191) */
    private $id;

    /**
     * @var iterable|Container[]
     * @ORM\OneToMany(targetEntity="App\Entity\Inventory\Container", mappedBy="user", cascade={"persist", "remove"})
     */
    private $containers = [];

    public function __construct(UserIdInterface $id, string $email, string $password)
    {
        $this->id = $id;
        $this->createdAt = new \DateTimeImmutable();
        $this->credential = new EmailPassword($email, $password);
        $this->confirmationToken = bin2hex(random_bytes(32));
    }

    public function getId(): UserIdInterface
    {
        return $this->id;
    }

    /**
     * @return DomainCollectionInterface|Container[]
     */
    public function getContainers(): DomainCollectionInterface
    {
        return $this->containers instanceof DomainCollectionInterface ? $this->containers : DomainCollectionFactory::create($this->containers);
    }

    /**
     * @param Container $container
     * @return User
     */
    public function addContainer(Container $container): self
    {
        if ($this->getContainers()->contains($container) === false) {
            $this->containers[] = $container;
        }
        return $this;
    }

    private function handleUserContainerAddedEvent(UserContainerAddedEvent $event): bool
    {
        $this->addContainer($event->container);

        return true;
    }
}
