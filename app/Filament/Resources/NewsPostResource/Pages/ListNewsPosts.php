<?php

namespace App\Filament\Resources\NewsPostResource\Pages;

use App\Filament\Resources\NewsPostResource;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;

class ListNewsPosts extends ListRecords
{
    protected static string $resource = NewsPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create'),
            Actions\Action::make('Add an article')
                ->form([
                    TextInput::make('url')
                        ->required()
                        ->url()
                        ->helperText('Enter article url. We will do the rest')
                ])
                ->action(function (array $data) {
                    $this->scrap($data['url']);
                })
        ];
    }

    public function scrap($url){

        $httpClient = new \GuzzleHttp\Client();

        $response = $httpClient->get($url);

        $htmlString = (string) $response->getBody();
        libxml_use_internal_errors(true);

        $doc = new \DOMDocument();
        $doc->loadHTML($htmlString);

        $xpath = new \DOMXPath($doc);

        $data = [];

        $title = $xpath->evaluate('//div[@class="headline__wrapper"]//h1');
        $author = $xpath->evaluate('//div[@class="byline__names"]//span');
        $date = $xpath->evaluate('//div[@class="timestamp"]');
        $content = $xpath->evaluate('//div[@class="article__content"]');

        $data['title'] = trim(preg_replace('/\s+/', ' ', $title[0]->textContent));
        $data['author'] = trim(preg_replace('/\s+/', ' ', $author[0]->textContent));
        $data['published_at'] = trim(preg_replace('/\s+/', ' ', $date[0]->textContent));
        $data['content'] = trim(preg_replace('/\s+/', ' ', $content[0]->textContent));

        dd($data);
    }
}
