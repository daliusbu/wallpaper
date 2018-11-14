<?php

namespace AppBundle\Command;

use AppBundle\Entity\Wallpaper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetupWallpapersCommand extends Command
{
    // Symfony 3.3 approach
//     /**
//      * @var string
//      */
//     private $projectDir;
//
//    /**
//     * SetupWallpapersCommand constructor.
//     * @param string $projectDir
//     */

    private $projectDir;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(string $projectDir = NULL, EntityManagerInterface $em)
     {
        $this->projectDir = $projectDir;
         parent::__construct();
         $this->em = $em;
     }


    protected function configure()
    {
        $this
            ->setName('app:setup-wallpapers')
            ->setDescription('...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $wallpapers = glob( $this->projectDir . "/web/images/*.*");

        $wallpaperCount = count($wallpapers);
        $fileNames = [];

        $io = new SymfonyStyle($input, $output);
        $io->title('Importing wallpapers');
        $io ->progressStart($wallpaperCount);

        foreach ($wallpapers as $wallpaper){

            $fileName = pathinfo($wallpaper)['basename'];

            $wp = (new Wallpaper())
                ->setFilename($fileName)
                ->setSlug(pathinfo($wallpaper)['filename'])
                ->setWidth(getimagesize($wallpaper)[0])
                ->setHeight(getimagesize($wallpaper)[1]);
            $this->em->persist($wp);
            $io->progressAdvance();
            $fileNames[] = [$fileName];
        }
        $this->em->flush();
        $io->progressFinish();

        $table = new Table($output);
        $table
            ->setHeaders(['File names'])
            ->setRows($fileNames);
        $table->render();
        $io->success(sprintf('Cool, we adeded %d wallpapers', $wallpaperCount));

    }

}
