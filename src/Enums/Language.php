<?php

namespace Laraeast\LaravelLocales\Enums;

use Illuminate\Support\HtmlString;

enum Language: string
{
    case AF = 'af';
    case SQ = 'sq';
    case AR = 'ar';
    case HY = 'hy';
    case EU = 'eu';
    case BE = 'be';
    case BN = 'bn';
    case BS = 'bs';
    case BG = 'bg';
    case CA = 'ca';
    case ZH = 'zh';
    case HR = 'hr';
    case CS = 'cs';
    case DA = 'da';
    case NL = 'nl';
    case EN = 'en';
    case ET = 'et';
    case FI = 'fi';
    case FR = 'fr';
    case GL = 'gl';
    case KA = 'ka';
    case DE = 'de';
    case EL = 'el';
    case GU = 'gu';
    case HE = 'he';
    case HI = 'hi';
    case HU = 'hu';
    case IS = 'is';
    case ID = 'id';
    case GA = 'ga';
    case IT = 'it';
    case JA = 'ja';
    case KN = 'kn';
    case KK = 'kk';
    case KO = 'ko';
    case LV = 'lv';
    case LT = 'lt';
    case MK = 'mk';
    case MS = 'ms';
    case ML = 'ml';
    case MR = 'mr';
    case MN = 'mn';
    case NE = 'ne';
    case NO = 'no';
    case FA = 'fa';
    case PL = 'pl';
    case PT = 'pt';
    case PA = 'pa';
    case RO = 'ro';
    case RU = 'ru';
    case SR = 'sr';
    case SK = 'sk';
    case SL = 'sl';
    case ES = 'es';
    case SW = 'sw';
    case SV = 'sv';
    case TA = 'ta';
    case TE = 'te';
    case TH = 'th';
    case TR = 'tr';
    case UK = 'uk';
    case UR = 'ur';
    case VI = 'vi';
    case CY = 'cy';

    public function getName(): string
    {
        return match ($this) {
            self::AF => 'Afrikaans',
            self::SQ => 'Shqip',
            self::AR => 'العربية',
            self::HY => 'Հայերեն',
            self::EU => 'Euskara',
            self::BE => 'Беларуская',
            self::BN => 'বাংলা',
            self::BS => 'Bosanski',
            self::BG => 'Български',
            self::CA => 'Català',
            self::ZH => '中文',
            self::HR => 'Hrvatski',
            self::CS => 'Čeština',
            self::DA => 'Dansk',
            self::NL => 'Nederlands',
            self::EN => 'English',
            self::ET => 'Eesti',
            self::FI => 'Suomi',
            self::FR => 'Français',
            self::GL => 'Galego',
            self::KA => 'ქართული',
            self::DE => 'Deutsch',
            self::EL => 'Ελληνικά',
            self::GU => 'ગુજરાતી',
            self::HE => 'עברית',
            self::HI => 'हिन्दी',
            self::HU => 'Magyar',
            self::IS => 'Íslenska',
            self::ID => 'Bahasa Indonesia',
            self::GA => 'Gaeilge',
            self::IT => 'Italiano',
            self::JA => '日本語',
            self::KN => 'ಕನ್ನಡ',
            self::KK => 'Қазақ тілі',
            self::KO => '한국어',
            self::LV => 'Latviešu',
            self::LT => 'Lietuvių',
            self::MK => 'Македонски',
            self::MS => 'Bahasa Melayu',
            self::ML => 'മലയാളം',
            self::MR => 'मराठी',
            self::MN => 'Монгол',
            self::NE => 'नेपाली',
            self::NO => 'Norsk',
            self::FA => 'فارسی',
            self::PL => 'Polski',
            self::PT => 'Português',
            self::PA => 'ਪੰਜਾਬੀ',
            self::RO => 'Română',
            self::RU => 'Русский',
            self::SR => 'Српски',
            self::SK => 'Slovenčina',
            self::SL => 'Slovenščina',
            self::ES => 'Español',
            self::SW => 'Kiswahili',
            self::SV => 'Svenska',
            self::TA => 'தமிழ்',
            self::TE => 'తెలుగు',
            self::TH => 'ไทย',
            self::TR => 'Türkçe',
            self::UK => 'Українська',
            self::UR => 'اُردُو',
            self::VI => 'Tiếng Việt',
            self::CY => 'Cymraeg',
        };
    }

    public function getDir(): string
    {
        return match ($this) {
            self::AR, self::FA, self::HE, self::UR => 'rtl',
            default => 'ltr',
        };
    }

    public function getCode(): string
    {
        return $this->value;
    }

    public function getSvgFlag(string|int $width = 30, string|int $height = 30): HtmlString
    {
        $svg = file_get_contents(__DIR__."/../../flags/{$this->value}.svg");

        $svg = preg_replace('/\swidth="[^"]*"/', ' width="'.$width.'"', $svg);

        $svg = preg_replace('/\sheight="[^"]*"/', ' height="'.$height.'"', $svg);

        return new HtmlString($svg);
    }
}
