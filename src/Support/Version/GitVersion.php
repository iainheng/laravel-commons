<?php
/**
 * GitVersion.php
 *
 * @author    Iain Heng <hengcs@gmail.com>
 * @copyright 2017 Heng Cheng Siang
 * @link      https://github.com/hengcs
 */

namespace Iainheng\Laravel\Support\Version;


class GitVersion
{
    private static function versionFile()
    {
        return base_path() . '/version';
    }

    private static function appName()
    {
        return \Config::get('app.name', 'app');
    }

    private static function trim($str)
    {
        return preg_replace('/^v/i', '', $str);
    }

    /**
     * Get the app's version string
     *
     * If a file <base>/version exists, its contents are trimmed and used.
     * Otherwise we get a suitable string from `git describe`.
     *
     * @throws RuntimeException if there is no version file and `git
     * describe` fails
     * @return string Version string
     */
    public static function getVersion()
    {
        // If we have a version file, just return its contents
        if (file_exists(self::versionFile())) {
            return self::trim(file_get_contents(self::versionFile()));
        }

        // Remember current directory
        $dir = getcwd();

        // Change to base directory
        chdir(base_path());

        // Get version string from git
        $output = shell_exec('git describe --always --tags --dirty');

        // Change back
        chdir($dir);

        if ($output === null) {
            throw new \RuntimeException("Could not get version string (no version file and `git describe` failed)");
        }

        return self::trim($output);
    }

    /**
     * Get a string identifying the app and version
     *
     * @see getVersion
     * @throws RuntimeException if there is no version file and `git
     * describe` fails
     * @return string App name and version string
     */
    public static function getNameAndVersion()
    {
        return self::appName() . '/' . self::getVersion();
    }
}