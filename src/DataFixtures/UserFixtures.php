<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;


class UserFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 5000, function(User $user, $count) {
            $user->setUsername('Username_'.$count)
                ->setFirstname('Firstname'.$this->faker->firstName)
                ->setLastname('Lastname'.$this->faker->lastName)
                ->setEmail('email'.$this->faker->numberBetween(5, 100).'@'.$this->faker->numberBetween(5, 100).'com');
            ;
        });
        $manager->flush();
    }
}