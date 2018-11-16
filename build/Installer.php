<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-11-16 11:23:50
 * @Modified time:      2018-11-16 11:42:39
 * @Description:        安装器
 */
namespace basement\build;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

class Installer extends LibraryInstaller
{
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::install($repo, $package);
        $linker_file = $this->getInstallPath($package) . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR . 'Linker.php';
        echo $linker_file . PHP_EOL;
        echo $this->getBaseInstallPath($package);
        file_put_contents('tmp.php', "<?php require $linker_file;");
        $this->filesystem->copy('tmp.php', $this->getBaseInstallPath($package));
        $this->filesystem->rmdir('tmp.php');
    }

    public function getInstallPath(PackageInterface $package)
    {
        return 'vendor/basement';
    }
}
