<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    public const FIELD_MAP = [
        'title' => 'title',
        'subtitle' => 'subtitle',
        'folder' => 'folder',
        'meaning' => 'meaning',
        'paragraph1' => 'paragraph1',
        'components' => 'components',
        'lab' => 'lab',
        'world_views' => 'world-views',
        'store' => 'store',
        'lab_description' => 'lab-description',
        'lab_1' => 'lab-1',
        'lab_2' => 'lab-2',
        'lab_3' => 'lab-3',
        'lab_4' => 'lab-4',
        'world_views_description' => 'world-views-description',
        'view_1' => 'view-1',
        'view_2' => 'view-2',
        'view_3' => 'view-3',
        'world_views_description_2' => 'world-views-description-2',
        'store_description' => 'store-description',
        'environment' => 'environment',
        'barzakh_project' => 'barzakh-project',
        'project_description' => 'project-description',
        'project_1' => 'project-1',
        'project_1_desc' => 'project-1-desc',
        'project_2' => 'project-2',
        'project_2_desc' => 'project-2-desc',
        'project_3' => 'project-3',
        'project_3_desc' => 'project-3-desc',
        'project_4' => 'project-4',
        'project_4_desc' => 'project-4-desc',
        'project_5' => 'project-5',
        'project_5_desc' => 'project-5-desc',
        'project_6' => 'project-6',
        'project_6_desc' => 'project-6-desc',
        'project_7' => 'project-7',
        'project_7_desc' => 'project-7-desc',
        'project_8' => 'project-8',
        'project_8_desc' => 'project-8-desc',
        'project_9' => 'project-9',
        'project_9_desc' => 'project-9-desc',
        'join_us' => 'join-us',
        'join_description' => 'join-description',
        'why_invest' => 'why-invest',
        'why_invest_1' => 'why-invest-1',
        'why_invest_2' => 'why-invest-2',
        'why_invest_3' => 'why-invest-3',
        'commitment' => 'commitment',
        'last' => 'last',
    ];

    protected $fillable = [
        'content_en',
        'content_ar',
    ];

    protected $casts = [
        'content_en' => 'array',
        'content_ar' => 'array',
    ];

    public static function fieldDefinitions(): array
    {
        return [
            [
                'title_key' => 'admin.about_group_hero',
                'fields' => [
                    ['key' => 'title', 'label_key' => 'admin.title', 'type' => 'text'],
                    ['key' => 'subtitle', 'label_key' => 'admin.subtitle', 'type' => 'text'],
                    ['key' => 'folder', 'label_key' => 'admin.about_folder_label', 'type' => 'text'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_concept',
                'fields' => [
                    ['key' => 'meaning', 'label_key' => 'admin.about_section_title', 'type' => 'text'],
                    ['key' => 'paragraph1', 'label_key' => 'admin.about_paragraph', 'type' => 'textarea'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_components',
                'fields' => [
                    ['key' => 'components', 'label_key' => 'admin.about_section_title', 'type' => 'text'],
                    ['key' => 'lab', 'label_key' => 'admin.about_lab_title', 'type' => 'text'],
                    ['key' => 'world_views', 'label_key' => 'admin.about_world_views_title', 'type' => 'text'],
                    ['key' => 'store', 'label_key' => 'admin.about_store_title', 'type' => 'text'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_lab',
                'fields' => [
                    ['key' => 'lab_description', 'label_key' => 'admin.about_description', 'type' => 'textarea'],
                    ['key' => 'lab_1', 'label_key' => 'admin.about_bullet_1', 'type' => 'textarea'],
                    ['key' => 'lab_2', 'label_key' => 'admin.about_bullet_2', 'type' => 'textarea'],
                    ['key' => 'lab_3', 'label_key' => 'admin.about_bullet_3', 'type' => 'textarea'],
                    ['key' => 'lab_4', 'label_key' => 'admin.about_bullet_4', 'type' => 'textarea'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_world_views',
                'fields' => [
                    ['key' => 'world_views_description', 'label_key' => 'admin.about_description', 'type' => 'textarea'],
                    ['key' => 'view_1', 'label_key' => 'admin.about_bullet_1', 'type' => 'text'],
                    ['key' => 'view_2', 'label_key' => 'admin.about_bullet_2', 'type' => 'text'],
                    ['key' => 'view_3', 'label_key' => 'admin.about_bullet_3', 'type' => 'text'],
                    ['key' => 'world_views_description_2', 'label_key' => 'admin.about_closing_paragraph', 'type' => 'textarea'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_store',
                'fields' => [
                    ['key' => 'store_description', 'label_key' => 'admin.about_description', 'type' => 'textarea'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_environment',
                'fields' => [
                    ['key' => 'environment', 'label_key' => 'admin.about_section_title', 'type' => 'text'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_capabilities',
                'fields' => [
                    ['key' => 'barzakh_project', 'label_key' => 'admin.about_section_title', 'type' => 'text'],
                    ['key' => 'project_description', 'label_key' => 'admin.about_description', 'type' => 'textarea'],
                    ['key' => 'project_1', 'label_key' => 'admin.about_project_item_1_title', 'type' => 'text'],
                    ['key' => 'project_1_desc', 'label_key' => 'admin.about_project_item_1_description', 'type' => 'textarea'],
                    ['key' => 'project_2', 'label_key' => 'admin.about_project_item_2_title', 'type' => 'text'],
                    ['key' => 'project_2_desc', 'label_key' => 'admin.about_project_item_2_description', 'type' => 'textarea'],
                    ['key' => 'project_3', 'label_key' => 'admin.about_project_item_3_title', 'type' => 'text'],
                    ['key' => 'project_3_desc', 'label_key' => 'admin.about_project_item_3_description', 'type' => 'textarea'],
                    ['key' => 'project_4', 'label_key' => 'admin.about_project_item_4_title', 'type' => 'text'],
                    ['key' => 'project_4_desc', 'label_key' => 'admin.about_project_item_4_description', 'type' => 'textarea'],
                    ['key' => 'project_5', 'label_key' => 'admin.about_project_item_5_title', 'type' => 'text'],
                    ['key' => 'project_5_desc', 'label_key' => 'admin.about_project_item_5_description', 'type' => 'textarea'],
                    ['key' => 'project_6', 'label_key' => 'admin.about_project_item_6_title', 'type' => 'text'],
                    ['key' => 'project_6_desc', 'label_key' => 'admin.about_project_item_6_description', 'type' => 'textarea'],
                    ['key' => 'project_7', 'label_key' => 'admin.about_project_item_7_title', 'type' => 'text'],
                    ['key' => 'project_7_desc', 'label_key' => 'admin.about_project_item_7_description', 'type' => 'textarea'],
                    ['key' => 'project_8', 'label_key' => 'admin.about_project_item_8_title', 'type' => 'text'],
                    ['key' => 'project_8_desc', 'label_key' => 'admin.about_project_item_8_description', 'type' => 'textarea'],
                    ['key' => 'project_9', 'label_key' => 'admin.about_project_item_9_title', 'type' => 'text'],
                    ['key' => 'project_9_desc', 'label_key' => 'admin.about_project_item_9_description', 'type' => 'textarea'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_join',
                'fields' => [
                    ['key' => 'join_us', 'label_key' => 'admin.title', 'type' => 'text'],
                    ['key' => 'join_description', 'label_key' => 'admin.about_description', 'type' => 'textarea'],
                ],
            ],
            [
                'title_key' => 'admin.about_group_why_invest',
                'fields' => [
                    ['key' => 'why_invest', 'label_key' => 'admin.about_section_title', 'type' => 'text'],
                    ['key' => 'why_invest_1', 'label_key' => 'admin.about_reason_1', 'type' => 'textarea'],
                    ['key' => 'why_invest_2', 'label_key' => 'admin.about_reason_2', 'type' => 'textarea'],
                    ['key' => 'why_invest_3', 'label_key' => 'admin.about_reason_3', 'type' => 'textarea'],
                    ['key' => 'commitment', 'label_key' => 'admin.about_commitment', 'type' => 'textarea'],
                    ['key' => 'last', 'label_key' => 'admin.about_closing_statement', 'type' => 'text'],
                ],
            ],
        ];
    }

    public static function defaultContentFor(string $locale): array
    {
        $translations = include resource_path("lang/{$locale}/about.php");
        $content = [];

        foreach (self::FIELD_MAP as $internalKey => $translationKey) {
            $content[$internalKey] = $translations[$translationKey] ?? '';
        }

        return $content;
    }

    public static function defaultAttributes(): array
    {
        return [
            'content_en' => self::defaultContentFor('en'),
            'content_ar' => self::defaultContentFor('ar'),
        ];
    }

    public static function contentKeys(): array
    {
        return array_keys(self::FIELD_MAP);
    }

    public function content(string $key, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $primary = $locale === 'ar' ? $this->content_ar : $this->content_en;
        $fallback = $locale === 'ar' ? $this->content_en : $this->content_ar;

        return $primary[$key] ?? $fallback[$key] ?? '';
    }
}
