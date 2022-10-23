<?php

it('asserts database content', function () {
    $count = count(\Craft::$app->sites->getAllSites());
    $this->assertDatabaseCount(\craft\db\Table::SITES, $count);
});

it('asserts database content on condition', function () {
    $section = \markhuot\craftpest\factories\Section::factory()->create();
    $entry = \markhuot\craftpest\factories\Entry::factory()->section($section)->create();

    $this->assertDatabaseHas(\craft\db\Table::CONTENT, [
        'title' => $entry->title,
    ]);
});

it('asserts database content is missing')
    ->assertDatabaseMissing(\craft\db\Table::CONTENT, ['title' => 'fooz baz']);

it('asserts trashed', function () {
    $section = \markhuot\craftpest\factories\Section::factory()->create();
    $entry = \markhuot\craftpest\factories\Entry::factory()->section($section)->create();
    $this->assertNotTrashed($entry);

    \Craft::$app->elements->deleteElement($entry);
    $this->assertTrashed($entry);
});
