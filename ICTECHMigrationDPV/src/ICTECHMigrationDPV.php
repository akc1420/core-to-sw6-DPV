<?php declare(strict_types=1);

namespace ICTECHMigrationDPV;

use ICTECHMigrationDPV\Util\Lifecycle\Custom\InstallCustomField;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\System\CustomField\CustomFieldTypes;

class ICTECHMigrationDPV extends Plugin
{
    public const CUSTOM_FIELD_SET_NAME_FOR_PRODUCT = 'custom_product';

    public const CUSTOM_FIELD_SET_NAME_FOR_BUECHER = 'custom_product_buecher';

    public const CUSTOM_FIELD_SET_NAME_FOR_EBOOKS = 'custom_product_ebooks';

    public const CUSTOM_FIELD_SET_NAME_FOR_SONSTIGES = 'custom_product_sonstiges';

    public const CUSTOM_FIELD_SET_NAME_FOR_ZEITSCHRIFTEN = 'custom_product_zeitschriften';

    public const CUSTOM_PROPERTY = 'custom_property';

    private array $customProductFieldArray = [
        'name' => self::CUSTOM_FIELD_SET_NAME_FOR_PRODUCT,
        'config' => [
            'label' => [
                'de-DE' => 'Benutzerdefinierte Felder für Produkt',
                'en-GB' => 'Custom Fields For Product',
            ],
        ],
        'customFields' => [
            [
                'name' => 'custom_product_video_url',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'type' => 'url',
                    'label' => [
                        'de-DE' => 'Video (URL)',
                        'en-GB' => 'Video (URL)',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Video-URL eingeben',
                        'en-GB' => 'Enter Video URL',
                    ],
                    'customFieldPosition' => 1,
                ],
            ],
            [
                'name' => 'custom_product_audio',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'type' => 'url',
                    'label' => [
                        'de-DE' => 'Audio (URL)',
                        'en-GB' => 'Audio (URL)',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Audio-URL eingeben',
                        'en-GB' => 'Enter Audio URL',
                    ],
                    'customFieldPosition' => 2,
                ],
            ],
            [
                'name' => 'custom_product_www',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'type' => 'url',
                    'label' => [
                        'de-DE' => 'WWW',
                        'en-GB' => 'WWW',
                    ],
                    'customFieldPosition' => 3,
                ],
            ],
            [
                'name' => 'custom_product_advantage',
                'type' => CustomFieldTypes::HTML,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'Produktvorteil',
                        'en-GB' => 'Product Advantage',
                    ],
                    'customFieldPosition' => 4,
                ],
            ],
            [
                'name' => 'custom_product_protection_area',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktschutzbereich',
                        'en-GB' => 'Product Protection Area',
                    ],
                    'customFieldPosition' => 5,
                ],
            ],
            [
                'name' => 'custom_product_target_group',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt Zielgruppe',
                        'en-GB' => 'Product Target Group',
                    ],
                    'customFieldPosition' => 6,
                ],
            ],
            [
                'name' => 'custom_product_intended_use',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt Verwendungszweck',
                        'en-GB' => 'Product Intended Use',
                    ],
                    'customFieldPosition' => 7,
                ],
            ],
            [
                'name' => 'custom_product_birds',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt Vögel',
                        'en-GB' => 'Product Birds',
                    ],
                    'customFieldPosition' => 8,
                ],
            ],
            [
                'name' => 'custom_product_guarantee',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktgarantie',
                        'en-GB' => 'Product Guarantee',
                    ],
                    'customFieldPosition' => 9,
                ],
            ],
            [
                'name' => 'custom_product_operating_manual',
                'type' => CustomFieldTypes::HTML,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'Produkt Betriebsanleitung',
                        'en-GB' => 'Product Operating manual',
                    ],
                    'customFieldPosition' => 10,
                ],
            ],
            [
                'name' => 'custom_product_warnings',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktwarnungen',
                        'en-GB' => 'Product Warnings',
                    ],
                    'customFieldPosition' => 11,
                ],
            ],
            [
                'name' => 'custom_product_included',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Enthaltenes Produkt',
                        'en-GB' => 'Product Included',
                    ],
                    'customFieldPosition' => 12,
                ],
            ],
            [
                'name' => 'custom_product_not_included',
                'type' => CustomFieldTypes::HTML,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'Produkt nicht inbegriffen',
                        'en-GB' => 'Product Not Included',
                    ],
                    'customFieldPosition' => 13,
                ],
            ],
            [
                'name' => 'custom_product_summary',
                'type' => CustomFieldTypes::HTML,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'Produkt-Zusammenfassung',
                        'en-GB' => 'Product Summary',
                    ],
                    'customFieldPosition' => 14,
                ],
            ],
            [
                'name' => 'custom_product_link_to_info',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktlink zur Info',
                        'en-GB' => 'Product link to info',
                    ],
                    'customFieldPosition' => 15,
                ],
            ],
            [
                'name' => 'custom_product_link_to_info_text',
                'type' => CustomFieldTypes::HTML,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'Produktlink zum Infotext',
                        'en-GB' => 'Product link to info text',
                    ],
                    'customFieldPosition' => 16,
                ],
            ],
            [
                'name' => 'custom_product_pdf',
                'type' => CustomFieldTypes::MEDIA,
                'config' => [
                    'componentName' => 'sw-media-field',
                    'label' => [
                        'de-DE' => 'Produkt pdf',
                        'en-GB' => 'Product pdf',
                    ],
                    'customFieldPosition' => 17,
                ],
            ],
            [
                'name' => 'custom_product_pdf1',
                'type' => CustomFieldTypes::MEDIA,
                'config' => [
                    'componentName' => 'sw-media-field',
                    'label' => [
                        'de-DE' => 'Produkt pdf1',
                        'en-GB' => 'Product pdf1',
                    ],
                    'customFieldPosition' => 18,
                ],
            ],
            [
                'name' => 'custom_product_video',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'type' => 'url',
                    'label' => [
                        'de-DE' => 'Produkt-Video',
                        'en-GB' => 'Product Video',
                    ],
                    'customFieldPosition' => 19,
                ],
            ],
            [
                'name' => 'custom_product_video_img',
                'type' => CustomFieldTypes::MEDIA,
                'config' => [
                    'componentName' => 'sw-media-field',
                    'label' => [
                        'de-DE' => 'Produkt-Video-Bild',
                        'en-GB' => 'Product Video Image',
                    ],
                    'customFieldPosition' => 20,
                ],
            ],
            [
                'name' => 'custom_product_video_text',
                'type' => CustomFieldTypes::HTML,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'Produkt Video Text',
                        'en-GB' => 'Product Video Text',
                    ],
                    'customFieldPosition' => 21,
                ],
            ],
            [
                'name' => 'custom_product_video2',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'type' => 'url',
                    'label' => [
                        'de-DE' => 'Produkt Video2',
                        'en-GB' => 'Product Video2',
                    ],
                    'customFieldPosition' => 22,
                ],
            ],
            [
                'name' => 'custom_product_video2_img',
                'type' => CustomFieldTypes::MEDIA,
                'config' => [
                    'componentName' => 'sw-media-field',
                    'label' => [
                        'de-DE' => 'Produkt-Video-Bild',
                        'en-GB' => 'Product Video Image',
                    ],
                    'customFieldPosition' => 23,
                ],
            ],
            [
                'name' => 'custom_product_video2_text',
                'type' => CustomFieldTypes::HTML,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'Produkt Video Text',
                        'en-GB' => 'Product Video Text',
                    ],
                    'customFieldPosition' => 24,
                ],
            ],
            [
                'name' => 'custom_product_video3',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'type' => 'url',
                    'label' => [
                        'de-DE' => 'Produkt Video3',
                        'en-GB' => 'Product Video3',
                    ],
                    'customFieldPosition' => 25,
                ],
            ],
            [
                'name' => 'custom_product_video3_img',
                'type' => CustomFieldTypes::MEDIA,
                'config' => [
                    'componentName' => 'sw-media-field',
                    'label' => [
                        'de-DE' => 'Produkt-Video-Bild',
                        'en-GB' => 'Product Video Image',
                    ],
                    'customFieldPosition' => 26,
                ],
            ],
            [
                'name' => 'custom_product_video3_text',
                'type' => CustomFieldTypes::HTML,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'Produkt Video Text',
                        'en-GB' => 'Product Video Text',
                    ],
                    'customFieldPosition' => 27,
                ],
            ],
            [
                'name' => 'custom_product_producer_link',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'type' => 'url',
                    'label' => [
                        'de-DE' => 'Link zum Produkthersteller',
                        'en-GB' => 'Product Producer Link',
                    ],
                    'customFieldPosition' => 28,
                ],
            ],
            [
                'name' => 'custom_product_gallery_id',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktgalerie id',
                        'en-GB' => 'Product Gallery id',
                    ],
                    'customFieldPosition' => 29,
                ],
            ],
            [
                'name' => 'custom_product_in_header',
                'type' => CustomFieldTypes::SWITCH,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt In der Kopfzeile',
                        'en-GB' => 'Product In header',
                    ],
                    'customFieldPosition' => 30,
                ],
            ],
            [
                'name' => 'custom_product_in_promotion',
                'type' => CustomFieldTypes::SWITCH,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt In Förderung',
                        'en-GB' => 'Product In Promotion',
                    ],
                    'customFieldPosition' => 31,
                ],
            ],
            [
                'name' => 'custom_product_against_animals',
                'type' => CustomFieldTypes::SWITCH,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt gegen Tiere',
                        'en-GB' => 'Product against animals',
                    ],
                    'customFieldPosition' => 32,
                ],
            ],
            [
                'name' => 'custom_product_against_birds',
                'type' => CustomFieldTypes::SWITCH,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt gegen Vögel',
                        'en-GB' => 'Product against birds',
                    ],
                    'customFieldPosition' => 33,
                ],
            ],
            [
                'name' => 'custom_product_soundlevel_calculator',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Schallpegelrechner für Produkte',
                        'en-GB' => 'Product sound level calculator',
                    ],
                    'customFieldPosition' => 34,
                ],
            ],
            [
                'name' => 'custom_product_faq_anker',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt-Faq anker',
                        'en-GB' => 'Product faq anker',
                    ],
                    'customFieldPosition' => 35,
                ],
            ],
            [
                'name' => 'custom_product_id',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produkt-ID',
                        'en-GB' => 'Product Id',
                    ],
                    'disabled' => 'disabled',
                    'customFieldPosition' => 36,
                ],
            ],
            [
                'name' => 'custom_product_data_id',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktdaten-ID',
                        'en-GB' => 'Product Data Id',
                    ],
                    'disabled' => 'disabled',
                    'customFieldPosition' => 37,
                ],
            ],
            [
                'name' => 'custom_product_part_data_id',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktteil-ID',
                        'en-GB' => 'Product Part Id',
                    ],
                    'disabled' => 'disabled',
                    'customFieldPosition' => 38,
                ],
            ],
        ],
        'relations' => [
            [
                'entityName' => 'product',
            ],
        ],

    ];

    private array $product_data_buecher = [
        'name' => self::CUSTOM_FIELD_SET_NAME_FOR_BUECHER,
        'config' => [
            'label' => [
                'de-DE' => 'Benutzerdefinierte Felder für buecher',
                'en-GB' => 'Custom Fields For buecher',
            ],
        ],
        'customFields' => [
            [
                'name' => 'custom_product_buecher_Seitenzahl',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Seitenzahl',
                        'en-GB' => 'Seitenzahl',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Seitenzahl eingeben',
                        'en-GB' => 'Enter Seitenzahl',
                    ],
                    'customFieldPosition' => 1,
                ],
            ],
            [
                'name' => 'custom_product_buecher_Erscheinungsjahr',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Erscheinungsjahr',
                        'en-GB' => 'Erscheinungsjahr',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Erscheinungsjahr eingeben',
                        'en-GB' => 'Enter Erscheinungsjahr',
                    ],
                    'customFieldPosition' => 2,
                ],
            ],
            [
                'name' => 'custom_product_buecher_Auflagenart',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Auflagenart',
                        'en-GB' => 'Auflagenart',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Auflagenart eingeben',
                        'en-GB' => 'Enter Auflagenart',
                    ],
                    'customFieldPosition' => 3,
                ]
            ],
            [
                'name' => 'custom_product_buecher_Reihe',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Reihe',
                        'en-GB' => 'Reihe',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Erscheinungsjahr eingeben',
                        'en-GB' => 'Enter Erscheinungsjahr',
                    ],
                    'customFieldPosition' => 4,
                ]
            ],
            [
                'name' => 'custom_product_buecher_Produktform',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktform',
                        'en-GB' => 'Produktform',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Produktform eingeben',
                        'en-GB' => 'Enter Produktform',
                    ],
                    'customFieldPosition' => 5,
                ]
            ],
                [
                    'name' => 'custom_product_buecher_slogan',
                    'type' => CustomFieldTypes::TEXT,
                    'config' => [
                        'label' => [
                            'de-DE' => 'slogan',
                            'en-GB' => 'slogan',
                        ],
                        'placeholder' => [
                            'de-DE' => 'slogan eingeben',
                            'en-GB' => 'Enter slogan',
                        ],
                        'customFieldPosition' => 6,
                    ]
                ],
                    [
                        'name' => 'custom_product_buecher_notations',
                        'type' => CustomFieldTypes::TEXT,
                        'config' => [
                            'componentName' => 'sw-text-editor',
                            'label' => [
                                'de-DE' => 'notations',
                                'en-GB' => 'notations',
                            ],
                            'placeholder' => [
                                'de-DE' => 'notations eingeben',
                                'en-GB' => 'Enter notations',
                            ],
                            'customFieldPosition' => 7,
                        ],
                    ]
        ],
        'relations' => [
            [
                'entityName' => 'product',
            ],
        ],

    ];

    private array $product_data_ebooks = [
        'name' => self::CUSTOM_FIELD_SET_NAME_FOR_EBOOKS,
        'config' => [
            'label' => [
                'de-DE' => 'Benutzerdefinierte Felder für ebooks',
                'en-GB' => 'Custom Fields For ebooks',
            ],
        ],
        'customFields' => [
            [
                'name' => 'custom_product_ebooks_issn',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'issn',
                        'en-GB' => 'issn',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Video-URL issn',
                        'en-GB' => 'Enter issn',
                    ],
                    'customFieldPosition' => 1,
                ],
            ],
            [
                'name' => 'custom_product_ebooks_fileformat',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'fileformat',
                        'en-GB' => 'fileformat',
                    ],
                    'placeholder' => [
                        'de-DE' => 'fileformat eingeben',
                        'en-GB' => 'Enter fileformat',
                    ],
                    'customFieldPosition' => 2,
                ],
            ],
            [
                'name' => 'custom_product_ebooks_filesize',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'filesize',
                        'en-GB' => 'filesize',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Erscheinungsjahr filesize',
                        'en-GB' => 'Enter filesize',
                    ],
                    'customFieldPosition' => 3,
                ]
            ],
            [
                'name' => 'custom_product_ebooks_Seitenzahl',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Seitenzahl',
                        'en-GB' => 'Seitenzahl',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Seitenzahl eingeben',
                        'en-GB' => 'Enter Seitenzahl',
                    ],
                    'customFieldPosition' => 4,
                ]
            ],
            [
                'name' => 'custom_product_ebooks_Erscheinungsjahr',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Erscheinungsjahr',
                        'en-GB' => 'Erscheinungsjahr',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Erscheinungsjahr eingeben',
                        'en-GB' => 'Enter Erscheinungsjahr',
                    ],
                    'customFieldPosition' => 5,
                ]
            ],
            [
                'name' => 'custom_product_ebooks_Auflagenart',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Auflagenart',
                        'en-GB' => 'Auflagenart',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Auflagenart eingeben',
                        'en-GB' => 'Enter Auflagenart',
                    ],
                    'customFieldPosition' => 6,
                ],
            ],
            [
                'name' => 'custom_product_ebooks_Reihe',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Reihe',
                        'en-GB' => 'Reihe',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Reihe eingeben',
                        'en-GB' => 'Enter Reihe',
                    ],
                    'customFieldPosition' => 7,
                ],
            ],
            [
                'name' => 'custom_product_ebooks_Produktform',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktform',
                        'en-GB' => 'Produktform',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Produktform eingeben',
                        'en-GB' => 'Enter Produktform',
                    ],
                    'customFieldPosition' => 8,
                ],
            ],
            [
                'name' => 'custom_product_ebooks_slogan',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'slogan',
                        'en-GB' => 'slogan',
                    ],
                    'placeholder' => [
                        'de-DE' => 'slogan eingeben',
                        'en-GB' => 'Enter slogan',
                    ],
                    'customFieldPosition' => 9,
                ],
            ],
            [
                'name' => 'custom_product_ebooks_notations',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'notations',
                        'en-GB' => 'notations',
                    ],
                    'placeholder' => [
                        'de-DE' => 'notations eingeben',
                        'en-GB' => 'Enter notations',
                    ],
                    'customFieldPosition' => 10,
                ],
            ],

        ],
        'relations' => [
            [
                'entityName' => 'product',
            ],
        ],

    ];

    private array $product_data_sonstiges = [
        'name' => self::CUSTOM_FIELD_SET_NAME_FOR_SONSTIGES,
        'config' => [
            'label' => [
                'de-DE' => 'Benutzerdefinierte Felder für sonstiges',
                'en-GB' => 'Custom Fields For sonstiges',
            ],
        ],
        'customFields' => [
            [
                'name' => 'custom_product_sonstiges_Reihe',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Reihe',
                        'en-GB' => 'Reihe',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Reihe eingeben',
                        'en-GB' => 'Enter Reihe',
                    ],
                    'customFieldPosition' => 1,
                ],
            ],
            [
                'name' => 'custom_product_sonstiges_Produktform',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktform',
                        'en-GB' => 'Produktform',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Produktform eingeben',
                        'en-GB' => 'Enter Produktform',
                    ],
                    'customFieldPosition' => 2,
                ],
            ],
            [
                'name' => 'custom_product_sonstiges_slogan',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'slogan',
                        'en-GB' => 'slogan',
                    ],
                    'placeholder' => [
                        'de-DE' => 'slogan eingeben',
                        'en-GB' => 'Enter slogan',
                    ],
                    'customFieldPosition' => 3,
                ]
            ],
            [
                'name' => 'custom_product_sonstiges_notations',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'notations',
                        'en-GB' => 'notations',
                    ],
                    'placeholder' => [
                        'de-DE' => 'notations eingeben',
                        'en-GB' => 'Enter notations',
                    ],
                    'customFieldPosition' => 4,
                ],
            ]
        ],
        'relations' => [
            [
                'entityName' => 'product',
            ],
        ],

    ];

    private array $product_data_zeitschriften = [
        'name' => self::CUSTOM_FIELD_SET_NAME_FOR_ZEITSCHRIFTEN,
        'config' => [
            'label' => [
                'de-DE' => 'Benutzerdefinierte Felder für zeitschriften',
                'en-GB' => 'Custom Fields For zeitschriften',
            ],
        ],
        'customFields' => [
            [
                'name' => 'custom_product_zeitschriften_issn',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'issn',
                        'en-GB' => 'issn',
                    ],
                    'placeholder' => [
                        'de-DE' => 'issn eingeben',
                        'en-GB' => 'Enter issn',
                    ],
                    'customFieldPosition' => 1,
                ],
            ],
            [
                'name' => 'custom_product_zeitschriften_Seitenzahl',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Seitenzahl',
                        'en-GB' => 'Seitenzahl',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Seitenzahl eingeben',
                        'en-GB' => 'Enter Seitenzahl',
                    ],
                    'customFieldPosition' => 2,
                ],
            ],
            [
                'name' => 'custom_product_zeitschriften_Erscheinungsjahr',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Erscheinungsjahr',
                        'en-GB' => 'Erscheinungsjahr',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Erscheinungsjahr eingeben',
                        'en-GB' => 'Enter Erscheinungsjahr',
                    ],
                    'customFieldPosition' => 3,
                ]
            ],
            [
                'name' => 'custom_product_zeitschriften_Auflagenart',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Auflagenart',
                        'en-GB' => 'Auflagenart',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Auflagenart eingeben',
                        'en-GB' => 'Enter Auflagenart',
                    ],
                    'customFieldPosition' => 4,
                ]
            ],
            [
                'name' => 'custom_product_zeitschriften_Reihe',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Reihe',
                        'en-GB' => 'Reihe',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Reihe eingeben',
                        'en-GB' => 'Enter Reihe',
                    ],
                    'customFieldPosition' => 5,
                ]
            ],
            [
                'name' => 'custom_product_zeitschriften_Produktform',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'Produktform',
                        'en-GB' => 'Produktform',
                    ],
                    'placeholder' => [
                        'de-DE' => 'Produktform eingeben',
                        'en-GB' => 'Enter Produktform',
                    ],
                    'customFieldPosition' => 6,
                ]
            ],
            [
                'name' => 'custom_product_zeitschriften_slogan',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'label' => [
                        'de-DE' => 'slogan',
                        'en-GB' => 'slogan',
                    ],
                    'placeholder' => [
                        'de-DE' => 'slogan eingeben',
                        'en-GB' => 'Enter slogan',
                    ],
                    'customFieldPosition' => 7,
                ]
            ],
            [
                'name' => 'custom_product_zeitschriften_notations',
                'type' => CustomFieldTypes::TEXT,
                'config' => [
                    'componentName' => 'sw-text-editor',
                    'label' => [
                        'de-DE' => 'notations',
                        'en-GB' => 'notations',
                    ],
                    'placeholder' => [
                        'de-DE' => 'notations eingeben',
                        'en-GB' => 'Enter notations',
                    ],
                    'customFieldPosition' => 8,
                ],
            ]
        ],
        'relations' => [
            [
                'entityName' => 'product',
            ],
        ],

    ];

    public function install(InstallContext $installContext): void
    {
        parent::install($installContext);

        /** @var EntityRepository $customFieldSetRepository */
        $customFieldSetRepository = $this->container
            ->get('custom_field_set.repository');

        /** @var EntityRepository $customFieldRepository */
        $customFieldRepository = $this->container
            ->get('custom_field.repository');

        (new InstallCustomField(
            $customFieldSetRepository,
            $customFieldRepository
        ))->install($installContext->getContext());

        $this->addCustomFieldsForProduct($installContext);

        $this->addCustomProperty($installContext);
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

        /** @var EntityRepository $customFieldSetRepository */
        $customFieldSetRepository = $this->container
            ->get('custom_field_set.repository');

        /** @var EntityRepository $customFieldRepository */
        $customFieldRepository = $this->container
            ->get('custom_field.repository');

        (new InstallCustomField(
            $customFieldSetRepository,
            $customFieldRepository
        ))->unInstall($uninstallContext->getContext());

        $this->deleteCustomFieldsForProduct($uninstallContext);

        $this->deleteCustomFieldsForBuecher($uninstallContext);

        $this->deleteCustomFieldsForEbooks($uninstallContext);

        $this->deleteCustomFieldsForSonstiges($uninstallContext);

        $this->deleteCustomFieldsForZeitschriften($uninstallContext);

        $this->deleteCustomProperty($uninstallContext);
    }

    public function addCustomFieldsForProduct(
        InstallContext $installContext
    ): void {
        $customFieldSetRepository = $this->container
            ->get('custom_field_set.repository');
        $customFieldSetRepository->create(
            [$this->customProductFieldArray],
            $installContext->getContext()
        );
        $customFieldSetRepository->create(
            [$this->product_data_buecher],
            $installContext->getContext()
        );
        $customFieldSetRepository->create(
            [$this->product_data_ebooks],
            $installContext->getContext()
        );
        $customFieldSetRepository->create(
            [$this->product_data_sonstiges],
            $installContext->getContext()
        );
        $customFieldSetRepository->create(
            [$this->product_data_zeitschriften],
            $installContext->getContext()
        );
    }

    public function deleteCustomFieldsForProduct(
        UninstallContext $uninstallContext
    ): void {
        $customFieldSetRepository = $this->container
            ->get('custom_field_set.repository');
        $criteria = new Criteria();

        $criteria->addFilter(
            new EqualsFilter(
                'name',
                self::CUSTOM_FIELD_SET_NAME_FOR_PRODUCT
            )
        );

        $result = $customFieldSetRepository->searchIds(
            $criteria,
            $uninstallContext->getContext()
        );

        if ($result->getTotal() > 0) {
            $data = $result->getDataOfId($result->firstId());
            $customFieldSetRepository->delete(
                [$data],
                $uninstallContext->getContext()
            );
        }
    }

    public function deleteCustomFieldsForBuecher(
        UninstallContext $uninstallContext
    ): void {
        $customFieldSetRepository = $this->container
            ->get('custom_field_set.repository');
        $criteria = new Criteria();

        $criteria->addFilter(
            new EqualsFilter(
                'name',
                self::CUSTOM_FIELD_SET_NAME_FOR_BUECHER
            )
        );

        $result = $customFieldSetRepository->searchIds(
            $criteria,
            $uninstallContext->getContext()
        );

        if ($result->getTotal() > 0) {
            $data = $result->getDataOfId($result->firstId());
            $customFieldSetRepository->delete(
                [$data],
                $uninstallContext->getContext()
            );
        }
    }

    public function deleteCustomFieldsForEbooks(
        UninstallContext $uninstallContext
    ): void {
        $customFieldSetRepository = $this->container
            ->get('custom_field_set.repository');
        $criteria = new Criteria();

        $criteria->addFilter(
            new EqualsFilter(
                'name',
                self::CUSTOM_FIELD_SET_NAME_FOR_EBOOKS
            )
        );

        $result = $customFieldSetRepository->searchIds(
            $criteria,
            $uninstallContext->getContext()
        );

        if ($result->getTotal() > 0) {
            $data = $result->getDataOfId($result->firstId());
            $customFieldSetRepository->delete(
                [$data],
                $uninstallContext->getContext()
            );
        }
    }

    public function deleteCustomFieldsForSonstiges(
        UninstallContext $uninstallContext
    ): void {
        $customFieldSetRepository = $this->container
            ->get('custom_field_set.repository');
        $criteria = new Criteria();

        $criteria->addFilter(
            new EqualsFilter(
                'name',
                self::CUSTOM_FIELD_SET_NAME_FOR_SONSTIGES
            )
        );

        $result = $customFieldSetRepository->searchIds(
            $criteria,
            $uninstallContext->getContext()
        );

        if ($result->getTotal() > 0) {
            $data = $result->getDataOfId($result->firstId());
            $customFieldSetRepository->delete(
                [$data],
                $uninstallContext->getContext()
            );
        }
    }

    public function deleteCustomFieldsForZeitschriften(
        UninstallContext $uninstallContext
    ): void {
        $customFieldSetRepository = $this->container
            ->get('custom_field_set.repository');
        $criteria = new Criteria();

        $criteria->addFilter(
            new EqualsFilter(
                'name',
                self::CUSTOM_FIELD_SET_NAME_FOR_ZEITSCHRIFTEN
            )
        );

        $result = $customFieldSetRepository->searchIds(
            $criteria,
            $uninstallContext->getContext()
        );

        if ($result->getTotal() > 0) {
            $data = $result->getDataOfId($result->firstId());
            $customFieldSetRepository->delete(
                [$data],
                $uninstallContext->getContext()
            );
        }
    }

    public function addCustomProperty(InstallContext $installContext): void
    {
        $propertyGroupRepository = $this->container
            ->get('property_group.repository');
        $propertyGroupRepository->create([
            [
                'name' => self::CUSTOM_PROPERTY,
            ],
        ], $installContext->getContext());
    }

    public function deleteCustomProperty(
        UninstallContext $uninstallContext
    ): void {
        $propertyGroupRepository = $this->container
            ->get('property_group.repository');
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('name', self::CUSTOM_PROPERTY));
        $result = $propertyGroupRepository->searchIds(
            $criteria,
            $uninstallContext->getContext()
        );

        if ($result->getTotal() > 0) {
            $data = $result->getDataOfId($result->firstId());
            $propertyGroupRepository->delete(
                [$data],
                $uninstallContext->getContext()
            );
        }
    }
}