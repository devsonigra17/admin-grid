<?php
namespace Dev\Crud\Model;

use Magento\Framework\Stdlib\DateTime\DateTimeFactory;

class FormatDate
{
    /**
     * Custom Date format
     */
    const FORMAT_DATE = 'dd-m-Y';

    /**
     * @var DateTimeFactory
     */
    private $dateTimeFactory;

    public function __construct(
        DateTimeFactory $dateTimeFactory
    ) {
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * Get Current Format date
     *
     * @return string
     */
    public function getFormatDate(): string
    {
        $dateModel = $this->dateTimeFactory->create();
        return $dateModel->gmtDate(self::FORMAT_DATE);
    }
}