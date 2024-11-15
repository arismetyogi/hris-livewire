<div class="flex items-center justify-between h-20 bg-white border-b border-gray-200 lg:p-2 lg:h-32">
	<x-application-logo class="block w-auto h-14 lg:h-24" />

	<h1 class="pr-4 text-lg font-medium text-gray-600">
			Welcome to {{ strtoupper(config('app.name')) }}, <span class="text-primary-500">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>!
	</h1>
</div>
