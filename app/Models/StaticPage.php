<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    public const DEFAULT_PAGES = [
        [
            'slug' => 'terms-of-use',
            'title_en' => 'Terms of Use',
            'title_ar' => 'شروط الاستخدام',
            'content_en' => "Welcome to Barzakh.\n\nBy using this platform, you agree to use our website, learning resources, and digital services in a lawful and respectful way. You must not misuse the platform, interfere with its operation, or attempt to access restricted areas without authorization.\n\nCourse materials, media, and platform content are provided for personal or authorized educational use unless stated otherwise. We may update these terms when needed to reflect changes in the service.",
            'content_ar' => "مرحبًا بكم في برزخ.\n\nباستخدام هذه المنصة، فإنك توافق على استخدام موقعنا ومواردنا التعليمية وخدماتنا الرقمية بطريقة قانونية ومحترمة. ويُمنع إساءة استخدام المنصة أو تعطيل عملها أو محاولة الوصول إلى المناطق المقيّدة دون تصريح.\n\nتُقدَّم الدروس والمواد والوسائط والمحتوى الموجود في المنصة للاستخدام الشخصي أو التعليمي المصرّح به ما لم يُذكر خلاف ذلك. ويجوز لنا تحديث هذه الشروط عند الحاجة بما يعكس أي تغييرات في الخدمة.",
        ],
        [
            'slug' => 'privacy-policy',
            'title_en' => 'Privacy Policy',
            'title_ar' => 'سياسة الخصوصية',
            'content_en' => "We value your privacy and handle your personal data with care.\n\nBarzakh may collect information needed to create accounts, provide educational services, process requests, and improve the platform experience. We do not use your information outside the purposes required to operate and develop the service.\n\nWe take reasonable steps to protect your information, and we may update this policy if our practices or legal obligations change.",
            'content_ar' => "نحن نُقدّر خصوصيتك ونتعامل مع بياناتك الشخصية بعناية.\n\nقد تجمع برزخ المعلومات اللازمة لإنشاء الحسابات وتقديم الخدمات التعليمية ومعالجة الطلبات وتحسين تجربة استخدام المنصة. ولا نستخدم معلوماتك إلا للأغراض اللازمة لتشغيل الخدمة وتطويرها.\n\nنتخذ خطوات معقولة لحماية معلوماتك، وقد نقوم بتحديث هذه السياسة إذا تغيّرت ممارساتنا أو التزاماتنا القانونية.",
        ],
        [
            'slug' => 'help-center',
            'title_en' => 'Help Center',
            'title_ar' => 'مركز المساعدة',
            'content_en' => "Need help using Barzakh?\n\nYou can contact our team for support related to your account, course access, technical issues, or general questions about the platform. When you contact us, please include enough detail so we can help you faster.\n\nWe aim to respond as quickly as possible and improve the experience based on the questions we receive most often.",
            'content_ar' => "هل تحتاج إلى مساعدة في استخدام برزخ؟\n\nيمكنك التواصل مع فريقنا للحصول على دعم يتعلق بحسابك أو الوصول إلى الدورات أو المشكلات التقنية أو أي استفسارات عامة حول المنصة. وعند التواصل معنا، يُرجى تزويدنا بتفاصيل كافية حتى نتمكن من مساعدتك بشكل أسرع.\n\nنسعى إلى الرد في أسرع وقت ممكن وتحسين التجربة بالاستفادة من أكثر الأسئلة والاستفسارات تكرارًا.",
        ],
    ];

    protected $fillable = [
        'slug',
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
    ];

    public static function ensureDefaults(): void
    {
        foreach (self::DEFAULT_PAGES as $page) {
            self::query()->firstOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }

    public function title(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        return $locale === 'ar'
            ? ($this->title_ar ?: $this->title_en)
            : ($this->title_en ?: $this->title_ar);
    }

    public function content(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        return $locale === 'ar'
            ? ($this->content_ar ?: $this->content_en)
            : ($this->content_en ?: $this->content_ar);
    }
}
