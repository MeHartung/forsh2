<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Michael Strucken <michael@strucken.it>
 */
final readonly class ContactFormRequestDto
{
    public function __construct(
        #[Assert\Type('string')]
        #[Assert\NotBlank]
        private string $email,
        #[Assert\Type('string')]
        #[Assert\NotBlank]
        private string $message,
        #[Assert\Type('string')]
        private ?string $firstName = null,
        #[Assert\Type('string')]
        private ?string $lastName = null,
        #[Assert\Type('string')]
        private ?string $phone = null
    ) {

    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
