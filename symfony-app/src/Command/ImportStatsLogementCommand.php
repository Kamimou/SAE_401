<?php

namespace App\Command;

use App\Entity\Departement;
use App\Entity\StatistiqueLogement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:stats-logement',
    description: 'Import statistics logement from CSV file',
)]
class ImportStatsLogementCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'Path to the CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csvFile = $input->getArgument('file');

        if (!file_exists($csvFile)) {
            $io->error('CSV file not found: ' . $csvFile);
            return Command::FAILURE;
        }

        $handle = fopen($csvFile, 'r');
        if ($handle === false) {
            $io->error('Failed to open CSV file');
            return Command::FAILURE;
        }

        // Skip header row
        fgetcsv($handle, 0, ';');
        
        $batchSize = 50;
        $count = 0;
        $skipped = 0;

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            // Get nom_departement from CSV column
            $nomDepartement = trim($row[2] ?? '');
            
            if (empty($nomDepartement)) {
                $skipped++;
                continue;
            }

            // Find departement by nomDepartement (PHP entity property name)
            $departement = $this->em->getRepository(Departement::class)->findOneBy([
                'nomDepartement' => $nomDepartement
            ]);
            
            if (!$departement) {
                $io->warning('Departement not found for name: ' . $nomDepartement);
                $skipped++;
                continue;
            }

            // Get nombreLogement from column 14 (index 14)
            $nombreLogement = isset($row[14]) ? (int) trim($row[14]) : 0;
            
            // Get construction from column 21 (index 21)
            $construction = isset($row[21]) ? (float) trim($row[21]) : 0.0;

            $statistiqueLogement = new StatistiqueLogement();
            $statistiqueLogement->setDepartement($departement);
            $statistiqueLogement->setNombreLogement($nombreLogement);
            $statistiqueLogement->setConstruction($construction);

            $this->em->persist($statistiqueLogement);
            $count++;

            if ($count % $batchSize === 0) {
                $this->em->flush();
                $io->write('.');
            }
        }

        $this->em->flush();
        fclose($handle);

        $io->success(sprintf(
            'Import completed! %d statistics logement imported, %d rows skipped.',
            $count,
            $skipped
        ));

        return Command::SUCCESS;
    }
}
