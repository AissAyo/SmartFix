<?php   
namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class userSignupDTO{
// name
    #[Assert\NotBlank(
        message: "would you please enter your name"
        )]

    #[Assert\Length(
        min:3,
        minMessage:"name must be at least 3 characters long"
     )]
    private $name;
// email
    
    #[Assert\NotBlank(
        message: "would you please enter your email"
        )]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private $email;
// password
    #[Assert\NotBlank(
        message: "would you please enter your password"
        )]
    #[Assert\Length(
        min:8,
        minMessage:"password must be at least 8 characters long"
     )]
    #[Assert\Regex(
        pattern: '/\d/',
        match: true,
        message: 'Your password must contain at least one number',
    )]
    #[Assert\Regex(
        pattern: '/[A-Z]/',
        match: true,
        message: 'Your password must contain at least one uppercase letter',
    )]
    #[Assert\Regex(
        pattern: '/[a-z]/',
        match: true,
        message: 'Your password must contain at least one lowercase letter',
    )]
    #[Assert\Regex(
        pattern: '/\W/',
        match: true,
        message: 'Your password must contain at least one special character',
    )]

    private $password;
// confirmation password

    #[Assert\NotBlank(
        message: "would you please confirm your password"
        )]
    #[Assert\EqualTo(
        propertyPath: 'password',
        message: 'The password does not match'
    )]

    private $confirmPassword;
// address
    #[Assert\NotBlank(
        message: "would you please enter your address"
        )]
    #[Assert\Length(
        min:3,
        minMessage:"address must be at least 3 characters long"
     )]
    private $address;
// phone
    #[Assert\NotBlank(
        message: "would you please enter your phone number"
        )]
    #[Assert\Length(
        min:8,
        minMessage:"phone number must be at least 8 characters long"
     )]
    #[Assert\Regex(
        pattern: '/\d/',
        match: true,
        message: 'Your phone number must contain only numbers',
    )]
    #[Assert\Regex(
        pattern: '/^0[5-7][0-9]{8}$/',
        match: true,
        message: 'Your phone number must start with 05, 06 or 07',
    )]
    private $phone;
// setter and getters

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
}