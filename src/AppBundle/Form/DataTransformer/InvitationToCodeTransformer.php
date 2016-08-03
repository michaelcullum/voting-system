<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Invitation;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * Transforms an Invitation to an invitation code.
 */
class InvitationToCodeTransformer implements DataTransformerInterface
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof Invitation) {
            throw new UnexpectedTypeException($value, 'AppBundle\Entity\Invitation');
        }

        return $value->getCode();
    }

    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $dql = <<<DQL
SELECT i
FROM AppBundle:Invitation i
WHERE i.code = :code
AND NOT EXISTS(SELECT 1 FROM AppBundle:User u WHERE u.invitation = i)
DQL;

        return $this->managerRegistry->getManager()
            ->createQuery($dql)
            ->setParameter('code', $value)
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }
}
