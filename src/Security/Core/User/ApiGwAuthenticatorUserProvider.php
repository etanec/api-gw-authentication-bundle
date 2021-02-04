<?php

declare(strict_types=1);

namespace EcPhp\ApiGwAuthenticatorBundle\Security\Core\User;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

use function get_class;

final class ApiGwAuthenticatorUserProvider implements ApiGwAuthenticatorUserProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByPayload(array $data): ApiGwAuthenticatorUserInterface
    {
        return new ApiGwAuthenticatorUser($data);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername(string $username): UserInterface
    {
        throw new UnsupportedUserException(sprintf('Username "%s" does not exist.', $username));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof ApiGwAuthenticatorUserInterface) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass(string $class): bool
    {
        return ApiGwAuthenticatorUser::class === $class;
    }
}