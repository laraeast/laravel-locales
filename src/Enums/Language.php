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
            self::SQ => 'Albanian',
            self::AR => 'Arabic',
            self::HY => 'Armenian',
            self::EU => 'Basque',
            self::BE => 'Belarusian',
            self::BN => 'Bengali',
            self::BS => 'Bosnian',
            self::BG => 'Bulgarian',
            self::CA => 'Catalan',
            self::ZH => 'Chinese',
            self::HR => 'Croatian',
            self::CS => 'Czech',
            self::DA => 'Danish',
            self::NL => 'Dutch',
            self::EN => 'English',
            self::ET => 'Estonian',
            self::FI => 'Finnish',
            self::FR => 'French',
            self::GL => 'Galician',
            self::KA => 'Georgian',
            self::DE => 'German',
            self::EL => 'Greek',
            self::GU => 'Gujarati',
            self::HE => 'Hebrew',
            self::HI => 'Hindi',
            self::HU => 'Hungarian',
            self::IS => 'Icelandic',
            self::ID => 'Indonesian',
            self::GA => 'Irish',
            self::IT => 'Italian',
            self::JA => 'Japanese',
            self::KN => 'Kannada',
            self::KK => 'Kazakh',
            self::KO => 'Korean',
            self::LV => 'Latvian',
            self::LT => 'Lithuanian',
            self::MK => 'Macedonian',
            self::MS => 'Malay',
            self::ML => 'Malayalam',
            self::MR => 'Marathi',
            self::MN => 'Mongolian',
            self::NE => 'Nepali',
            self::NO => 'Norwegian',
            self::FA => 'Persian',
            self::PL => 'Polish',
            self::PT => 'Portuguese',
            self::PA => 'Punjabi',
            self::RO => 'Romanian',
            self::RU => 'Russian',
            self::SR => 'Serbian',
            self::SK => 'Slovak',
            self::SL => 'Slovenian',
            self::ES => 'Spanish',
            self::SW => 'Swahili',
            self::SV => 'Swedish',
            self::TA => 'Tamil',
            self::TE => 'Telugu',
            self::TH => 'Thai',
            self::TR => 'Turkish',
            self::UK => 'Ukrainian',
            self::UR => 'Urdu',
            self::VI => 'Vietnamese',
            self::CY => 'Welsh',
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
