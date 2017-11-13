<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 11:27
 */

namespace NAOBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Command\DoctrineCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class UploadDataCommand extends DoctrineCommand
{
    protected function configure()
    {
        $message = "This command allows you to easily add all the TAXREF data, and the system data"
            . " in your database. This command should be run once the database has been created, after"
            . " the migration.";
        $this->setName('app:load-data')
            ->setDescription('Add TAXREF and system data')
            ->setHelp($message);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            "",
            "================",
            "= Data loading =",
            "================",
            "",
            "This command will load all TAXREF and system data in your database. It needs to",
            "be run on a new install.",
            "",
        ]);

        //check user wants to load the data
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Continue with this action (y/n)?', false);

        if (!$helper->ask($input, $output, $question)) {
            return;
        }

        try {
            //load TAXREF generic data
            $output->writeln([
                "",
                "1 - Loading TAXREF generic data",
                "    ---------------------------",
                "",
                "Please wait...",
                "",
            ]);
            $filename = __DIR__ . '/../db/order.sql';
            $sql = file_get_contents($filename);
            $connectionName = $this->getContainer()->get('doctrine')->getDefaultConnectionName();
            $this->getDoctrineConnection($connectionName)->executeQuery($sql);
            $output->writeln([
                "All TAXREF generic data has been loaded correctly.",
                "",
            ]);

            //load bird data
            $output->writeln([
                "",
                "2 - Loading TAXREF birds",
                "    --------------------",
                "",
                "Please wait...",
                "",
            ]);
            $progressBirds = new ProgressBar($output, 8);
            $progressBirds->start();
            for ($i = 1; $i < 9; $i++) {
                $filename = __DIR__ . '/../db/' . 'birds-' . $i . '.sql';
                $sql = file_get_contents($filename);
                $this->getDoctrineConnection($connectionName)->executeQuery($sql);
                $progressBirds->advance();
            }
            $progressBirds->finish();
            $output->writeln([
                "",
                "All TAXREF bird data has been loaded correctly.",
                "",
            ]);

            //load picture data
            $output->writeln([
                "",
                "3 - Loading birds picture links",
                "    ---------------------------",
                "",
                "Please wait...",
                "",
            ]);
            $progressPics = new ProgressBar($output, 5);
            $progressPics->start();
            for ($i = 1; $i < 6; $i++) {
                $filename = __DIR__ . '/../db/' . 'picture-' . $i . '.sql';
                $sql = file_get_contents($filename);
                $this->getDoctrineConnection($connectionName)->executeQuery($sql);
                $progressPics->advance();
            }
            $progressPics->finish();
            $output->writeln([
                "",
                "All TAXREF bird data has been loaded correctly.",
                "",
            ]);

            //load picture data
            $output->writeln([
                "",
                "4 - Loading NAO application main system data",
                "    ----------------------------------------",
                "",
                "Please wait...",
                "",
            ]);
            $filename = __DIR__ . '/../db/sysdata.sql';
            $sql = file_get_contents($filename);
            $this->getDoctrineConnection($connectionName)->executeQuery($sql);
            $output->writeln([
                "",
                "All TAXREF bird data has been loaded correctly.",
                "",
            ]);

            //Asking for adding fake data
            $question = new ConfirmationQuestion('Would you like to add fake data (y/n)?', false);

            if ($helper->ask($input, $output, $question)) {
                $output->writeln([
                    "",
                    "5 - Loading fake data for testing and demo",
                    "    --------------------------------------",
                    "",
                    "Please wait...",
                    "",
                ]);
                $filename = __DIR__ . '/../db/fakedata.sql';
                $sql = file_get_contents($filename);
                $this->getDoctrineConnection($connectionName)->executeQuery($sql);
                $output->writeln([
                    "",
                    "Fake data has been loaded correctly.",
                    "",
                ]);
            }
            $output->writeln([
                "",
                "All processes terminated.",
                "",
                "",
                "All the data has been succesfully loaded to the database.",
                "The web site may be used...",
                "",
            ]);

        } catch (Exception $e) {
            $output->writeln(sprintf('<error>Could not load data in database :</error>'));
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
        }
    }
}