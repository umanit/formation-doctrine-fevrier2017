<?php

namespace Imie\Entity;

/**
 * @Entity
 * @Table(name="post")
 */
class Post
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @Column(name="subject", type="string")
     */
    private $subject;

    /**
     * @Column(name="message", type="text")
     */
    private $message;

    /**
     * @Column(name="date", type="datetime")
     */
    private $date;
}
