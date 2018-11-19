<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-11-19 15:52:58
 * @Modified time:      2018-11-19 19:47:28
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
        var_dump($io);
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
        $this->io->notice($content);
        $this->io->notice($this->getPackageBasePath($package) . DIRECTORY_SEPARATOR . 'linker.php');
        $this->io->notice(file_put_contents($this->getPackageBasePath($package) . DIRECTORY_SEPARATOR . 'linker.php', $content));
    }
    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::uninstall($repo, $package);
        $require_file = $this->getPackageBasePath($package) . DIRECTORY_SEPARATOR . 'linker.php';
        $this->filesystem->unlink($require_file); //删除require文件
    }

}
