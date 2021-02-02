<?php

namespace App\Services\Image;

use App\Services\Data\SettingService;

class ImageCaptioningService
{
    protected $imageCaptioningService;

    public function __construct()
    {
        $this->imageCaptioningService = new LImageHandler;
    }

    public function propertyPicture(array $data)
    {
        in_array($data['country'], SettingService::getCountries()) ?: abort(404);
        in_array($data['city'], SettingService::CITIES) ?: abort(404);
        $data['profit'] = round($data['profit'], 1);
        $data['payback'] = round($data['payback'], 1);

        $fileName = $this->translit($data['address']);
        $profit = $data['profit'] . '%';
        if ($data['language'] == 'ru') {
            $years = $data['payback'] . $this->getYears($data['language'], $data['payback']);
            $payback = SettingService::PAYBACK[$data['language']] ?? '';
            $addProfitOffsetX = 0;
            $addPerYearOffsetX = 766;
            $addPaybackOffsetX = 748;
            $addYearsOffsetX = 0;
        } else {
            $years = $data['payback'];
            $payback = $this->getYears($data['language'], $data['payback']);
            $addProfitOffsetX = 0;
            $addPerYearOffsetX = 751;
            $addYearsOffsetX = 795;
            $addPaybackOffsetX = 788;
        }
        $perYear = SettingService::PER_YEAR[$data['language']] ?? '';
        $projectName = SettingService::PROJECTS[$data['project']] ?? '';

        $borderImage = storage_path('property') . '/' . (SettingService::DESIGN[$data['district']] ?? SettingService::DESIGN['default']);
        $houseImage = storage_path('property') . '/house/' . $data['country'] . '/' . $data['city'] . '/' . substr($fileName, 0, 1) . '/' . $fileName . '.jpg';
        is_file($houseImage) ?: $houseImage = storage_path('property') . '/city/' . $data['city'] . '.jpg';
        $flagImage = storage_path('property') . '/flag/' . $data['country'] . '.png';
        $fontPath = storage_path('property') . '/fonts/10369.ttf';
        is_file($borderImage) && is_file($houseImage) && is_file($flagImage) && is_file($fontPath) ?: abort(404);

        $texts =
            [
                [
                    'content'  => SettingService::TRANSLATE_CITIES[$data['language']][$data['city']] ?? '',
                    'fontFile' => $fontPath,
                    'size'     => 50,
                    'color'    => array(123, 19, 42),
                    'corner'   => LImageHandler::CORNER_LEFT_TOP,
                    'offsetX'  => 200,
                    'offsetY'  => 30,
                    'angle'    => 0,
                    'alpha'    => 20
                ],
                [
                    'content'  => $profit,
                    'fontFile' => $fontPath,
                    'size'     => 43,
                    'color'    => array(74, 70, 71),
                    'corner'   => LImageHandler::CORNER_LEFT_TOP,
                    'offsetX'  => $addProfitOffsetX ? $addProfitOffsetX : 786 - round((strlen($profit) - 2) * (35 / 3)),
                    'offsetY'  => 185,
                    'angle'    => 0,
                    'alpha'    => 20
                ],
                [
                    'content'  => $perYear,
                    'fontFile' => $fontPath,
                    'size'     => 25,
                    'color'    => array(74, 70, 71),
                    'corner'   => LImageHandler::CORNER_LEFT_TOP,
                    'offsetX'  => $addPerYearOffsetX,
                    'offsetY'  => 270,
                    'angle'    => 0,
                    'alpha'    => 20
                ],
                [
                    'content'  => $years,
                    'fontFile' => $fontPath,
                    'size'     => 27,
                    'color'    => array(74, 70, 71),
                    'corner'   => LImageHandler::CORNER_LEFT_TOP,
                    'offsetX'  => $addYearsOffsetX ? $addYearsOffsetX : 785 - round((mb_strlen($profit, 'UTF-8') - 2) * (35 / 3)),
                    'offsetY'  => 558,
                    'angle'    => 0,
                    'alpha'    => 20
                ],
                [
                    'content'  => $payback,
                    'fontFile' => $fontPath,
                    'size'     => 20,
                    'color'    => array(74, 70, 71),
                    'corner'   => LImageHandler::CORNER_LEFT_TOP,
                    'offsetX'  => $addPaybackOffsetX,
                    'offsetY'  => 600,
                    'angle'    => 0,
                    'alpha'    => 20
                ],
                [
                    'content'  => $projectName,
                    'fontFile' => $fontPath,
                    'size'     => 27,
                    'color'    => array(255, 255, 255),
                    'corner'   => LImageHandler::CORNER_LEFT_TOP,
                    'offsetX'  => 680,
                    'offsetY'  => 27,
                    'angle'    => 0.55,
                    'alpha'    => 0
                ]
            ];
        return $this->showPicture($borderImage, $houseImage, $flagImage, $texts, $data['width'] ?? 0);
    }

    public function translit(string $s)
    {
        $s = strip_tags($s);
        $s = str_replace(["\n", "\r"], " ", $s);
        $s = preg_replace("/\s+/", ' ', $s);
        $s = trim($s);
        $s = mb_strtolower($s, 'UTF-8');
        $s = strtr($s, ['а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ė' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => '', 'ä' => 'ae', 'ā' => 'aa', 'č' => 'ch', 'ē' => 'ee', 'ģ' => 'dz', 'ī' => 'ii', 'ķ' => 'kj', 'ļ' => 'lj', 'ņ' => 'nj', 'ö' => 'oe', 'õ' => 'yo', 'ß' => 'ss', 'š' => 'sh', 'ü' => 'ue', 'ū' => 'uu', 'ų' => 'yu', 'ž' => 'zh', '/' => '-']);
        $s = preg_replace("/[^0-9a-z_ \-]/i", "", $s);
        return str_replace(' ', '_', $s);
    }

    private function showPicture($borderImage, $houseImage, $flagImage, $texts, int $resizeWidth = 0)
    {
        $picture = imagecreatefromjpeg($borderImage);
        $housePicture = $this->resize($houseImage, 597, 425);
        imagecopy($picture, $housePicture, 64, 182, 0, 0, 597, 425);
        imagedestroy($housePicture);

        $flagPicture = imagecreatefrompng($flagImage);
        list($width, $height, $type) = getimagesize($flagImage);
        imagecopy($picture, $flagPicture, 0, 10, 0, 0, $width, $height);
        imagedestroy($flagPicture);

        $picturePath = storage_path('template') . '/picture_' . preg_replace("/\D/s", "", microtime()) . '.jpg';
        imagejpeg($picture, $picturePath, 100);
        imagedestroy($picture);

        $imgObj = $this->imageCaptioningService->load($picturePath);
        foreach ($texts as $text) {
            $imgObj->text($text['content'], $text['fontFile'], $text['size'], $text['color'], $text['corner'], $text['offsetX'], $text['offsetY'], $text['angle'], $text['alpha']);
        }
        !max($resizeWidth, 0) ?: $imgObj->resize($resizeWidth, false);
        $imgObj->save($picturePath, LImageHandler::IMG_JPEG, 90);

        $image = file_get_contents($picturePath);
        if (is_file($picturePath)) {
            unlink($picturePath);
        }
        return $image;
    }

    private function resize($filePath, $w, $h)
    {
        list($wrow, $hrow, $type) = getimagesize($filePath);
        if (!$wrow or !$hrow) {
            return;
        }
        $imgrow = imagecreatefromjpeg($filePath);
        if ($wrow == $w and $hrow == $h) {
            return $imgrow;
        }
        if ($wrow > $w or $hrow > $h) {
            $kw = $wrow / $w;
            $kh = $hrow / $h;
            if ($kw > $kh) {
                $wres = $wrow * $kh / $kw;
                $hres = $hrow;
                $xres = ($wrow - $wres) / 2;
                $yres = 0;
            } else {
                $wres = $wrow;
                $hres = $hrow * $kw / $kh;
                $xres = 0;
                $yres = ($hrow - $hres) / 2;
            }
            $img = imagecreatetruecolor($w, $h);
            imagecopyresampled($img, $imgrow, 0, 0, $xres, $yres, $w, $h, $wres, $hres);
        } else {
            $kw = $w / $wrow;
            $kh = $h / $hrow;
            if ($kw > $kh) {
                $kw = $kh;
            } else {
                $kh = $kw;
            }
            $wres = $wrow * $kw;
            $hres = $hrow * $kh;
            $img = imagecreatetruecolor($wres, $hres);
            imagecopyresampled($img, $imgrow, 0, 0, 0, 0, $wres, $hres, $wrow, $hrow);
        }
        return $img;
    }

    private function getYears($lg, $n)
    {
        $b1 = substr("$n", -1);
        $b2 = substr("$n", -2);
        if ($lg == 'en') {
            $result = ' years';
            if ($n == '1') {
                $result = ' year';
            }
        } elseif ($lg == 'ru') {
            $result = 'лет';
            if ($n == (int)$n) {
                if ($b1 == "1" and $b2 <> "11") {
                    $result = 'год';
                }
                if ($b1 == "2" and $b2 <> "12") {
                    $result = 'года';
                }
                if ($b1 == "3" and $b2 <> "13") {
                    $result = 'года';
                }
                if ($b1 == "4" and $b2 <> "14") {
                    $result = 'года';
                }
            }
            $result = ' ' . $result;
        } else {
            $result = '';
        }
        return $result;
    }
}
