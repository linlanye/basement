<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-11-19 15:52:58
 * @Modified time:      2018-11-19 21:16:05
 * @Description:        composer安装器
 */
namespace basement\installer;

use Composer\Composer;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Plugin\PluginInterface;
use Composer\Repository\InstalledRepositoryInterface;

class Installer implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $composer->getInstallationManager()->addInstaller(new BasementInstaller($io, $composer));
    }
}

class BasementInstaller extends LibraryInstaller
{
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::install($repo, $package);
        $Linker  = $this->getInstallPath($package) . '/src/installer/Linker.php';
        $content = "<?php require $Linker;";
        $this->io->warning($content);
        $this->io->warning($this->getPackageBasePath($package) . DIRECTORYSEPARATOR . 'linker.php');
        $this->io->warning(file_put_contents($this->getPackageBasePath($package) . DIRECTORY_SEPARATOR . 'linker.php', $content));
    }
    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::uninstall($repo, $package);
        $require_file = $this->getPackageBasePath($package) . DIRECTORY_SEPARATOR . 'linker.php';
        $this->filesystem->unlink($require_file); //删除require文件
    }
    public function supports($packageType)
    {
        var_dump($packageType);
        return 'basement-installer' === $packageType;
    }
}
