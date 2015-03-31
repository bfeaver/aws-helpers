<?php
namespace Bfeaver\AwsHelper\Command;

use Aws\S3\S3Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class S3SignedUrlCommand extends Command
{
    protected function configure()
    {
        $this->setName('s3:sign_url')
            ->addArgument('bucket', InputArgument::REQUIRED, 'The bucket name.')
            ->addArgument('object', InputArgument::REQUIRED, 'The object key.')
            ->addOption(
                'expires',
                'e',
                InputOption::VALUE_OPTIONAL,
                'The amount of time in minutes before the URL expires.',
                10
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = S3Client::factory(['profile' => 'default']);

        $url = $client->getObjectUrl($input->getArgument('bucket'), $input->getArgument('object'), '+10 minutes');

        $output->writeln('<info>Signed URL:</info> ' . $url);
    }
}
