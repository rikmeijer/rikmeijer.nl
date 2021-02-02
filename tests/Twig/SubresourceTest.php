<?php /** @noinspection JSUnresolvedLibraryURL */
/** @noinspection HtmlUnknownTarget */
declare(strict_types=1);

namespace rikmeijer\rikmeijernl\tests\Twig;

use PHPUnit\Framework\TestCase;
use rikmeijer\rikmeijernl\Twig\Subresource;

final class SubresourceTest extends TestCase
{
    public function testWhen_UnknownExtension_Expect_EmptyString() : void {
        $object = new Subresource([]);
        self::assertEmpty($object('/img/custom.jpg'));
    }
    public function testWhen_LocalCSSFile_Expect_LinkWithStylesheetRelationship() : void {
        $object = new Subresource([]);
        self::assertEquals('<link href="/css/custom.css" rel="stylesheet">', $object('/css/custom.css'));
    }
    public function testWhen_LocalPGPFile_Expect_LinkWithPGPKeyRelationship() : void {
        $object = new Subresource([]);
        self::assertEquals('<link href="/personal.pgp" rel="pgpkey">', $object('/personal.pgp'));
    }
    public function testWhen_RemoteCSSFile_Expect_LinkWithStylesheetRelationshipAndCrossOriginAttributes() : void {
        $object = new Subresource([]);
        self::assertEquals('<link href="https://example.com/css/custom.css" rel="stylesheet" crossorigin="anonymous">', $object('https://example.com/css/custom.css'));
    }
    public function testWhen_KnownIntegrityHashRemoteCSSFile_Expect_LinkWithStylesheetRelationshipAndIntegrityHashAndCrossOriginAttributes() : void {
        $object = new Subresource([
            'integrity-hashes' => [
                'https://example.com/css/custom.css' => 'MySuperSafeHash'
            ]
        ]);
        self::assertEquals('<link href="https://example.com/css/custom.css" rel="stylesheet" crossorigin="anonymous" integrity="MySuperSafeHash">', $object('https://example.com/css/custom.css'));
    }
    public function testWhen_KnownIntegrityHashLocalCSSFile_Expect_LinkWithStylesheetRelationshipAndIntegrityHashAttributes() : void {
        $object = new Subresource([
            'integrity-hashes' => [
                '/css/custom.css' => 'MySuperSafeHash'
            ]
        ]);
        self::assertEquals('<link href="/css/custom.css" rel="stylesheet" integrity="MySuperSafeHash">', $object('/css/custom.css'));
    }


    public function testWhen_LocalJavaScriptFile_Expect_ScriptTagWithSRC() : void {
        $object = new Subresource([]);
        self::assertEquals('<script src="/js/custom.js"></script>', $object('/js/custom.js'));
    }
    public function testWhen_RemoteJavaScriptFile_Expect_ScriptTagWithSRCAndCrossOriginAttributes() : void {
        $object = new Subresource([]);
        self::assertEquals('<script src="https://example.com/js/custom.js" crossorigin="anonymous"></script>', $object('https://example.com/js/custom.js'));
    }
    public function testWhen_RemoteJavaScriptFileAndKnownIntegrityHash_Expect_ScriptTagWithSRCAndIntegrityAndCrossOriginAttributes() : void {
        $object = new Subresource([
            'integrity-hashes' => [
                'https://example.com/js/custom.js' => 'MySuperSafeHash'
            ]
        ]);
        self::assertEquals('<script src="https://example.com/js/custom.js" crossorigin="anonymous" integrity="MySuperSafeHash"></script>', $object('https://example.com/js/custom.js'));
    }
    public function testWhen_LocalJavaScriptFileAndKnownIntegrityHash_Expect_ScriptTagWithSRCAndIntegrityAttributes() : void {
        $object = new Subresource([
            'integrity-hashes' => [
                '/js/custom.js' => 'MySuperSafeHash'
            ]
        ]);
        self::assertEquals('<script src="/js/custom.js" integrity="MySuperSafeHash"></script>', $object('/js/custom.js'));
    }
}
