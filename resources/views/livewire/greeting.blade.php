<div class="flex items-center justify-between p-6 bg-white border-b border-gray-200 lg:p-8">
	<x-application-logo class="block w-auto h-12" />

	<h1 class="text-lg font-medium text-gray-600">
			Welcome to {{ config('app.name') }}, <span class="text-indigo-500">{{ auth()->user()->name }}</span>!
	</h1>
</div>
