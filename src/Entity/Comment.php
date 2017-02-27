<?php

namespace Imie\Entity;

/**
 * @Entity
 * @Table(name="comment")
 */
class Comment
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @Column(name="message", type="text")
     */
    private $message;

    /**
     * @Column(name="date", type="datetime")
     */
    private $date;
}
