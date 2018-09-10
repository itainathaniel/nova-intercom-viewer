<?php

namespace Itainathaniel\IntercomViewer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intercom\IntercomClient;

class IntercomViewerController
{
	public $client;

	public function __construct()
	{
		$this->client = new IntercomClient(config('services.intercom.token'), null);
	}

	public function show($user_id)
	{
		$user_data = Cache::remember('itainathaniel::intercom::show', 5, function () use ($user_id) {
			return $this->client->users->getUsers(['user_id' => $user_id]);
		});

		return response(collect($user_data)->toArray(), 200);
	}

	public function conversations($user_id)
	{
		$conversations = Cache::remember('itainathaniel::intercom::conversations', 5, function () use ($user_id) {
			return $this->client->conversations->getConversations(['user_id' => $user_id]);
		});

		return response(array_reverse($conversations->conversations), 200);
	}

	public function events($user_id)
	{
		$events = Cache::remember('itainathaniel::intercom::events', 5, function () use ($user_id) {
			return $this->client->events->getEvents(['user_id' => $user_id]);
		});

		return response($events->events, 200);
	}

	public function notes($user_id)
	{
		$notes = Cache::remember('itainathaniel::intercom::notes', 5, function () use ($user_id) {
			return $this->client->notes->getNotes(['user_id' => $user_id]);
		});

		return response($notes->notes, 200);
	}
}
