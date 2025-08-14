<x-layouts.admin class="admin">
    <div class="p-4">
        <div class=" flex justify-between">
            <div class="text-xl font-semibold">All Freqeuntly Asked Question</div>
            <flux:action-a href="{{ route('faq.create') }}" class="bg-mine-400">
                <flux:icon.plus variant="micro" class="pencil-square"></flux:icon.plus>
                Add new FaQ
            </flux:action-a>
        </div>

        <flux:session></flux:session>

        <div class="grid grid-cols-1 gap-4 mt-4">
            @foreach ($faq as $item)
            <div class="rounded  bg-white dark:bg-neutral-700">
                <div class="bg-mine-400 py-2 px-4 flex justify-between rounded">
                    <div class="">{{ $item->question }}</div>
                    <div class="flex gap-4 items-center">
                        <flux:action-a href="{{ route('faq.edit', ['faq'=>$item->id]) }}" class="bg-amber-300">
                            <flux:icon.pencil-square variant="micro" class="pencil-square"></flux:icon.pencil-square>
                            Edit
                        </flux:action-a>
                        <form action="{{ route('faq.destroy', ['faq' => $item->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <flux:action-a as class="bg-rose-500">
                                <flux:icon.trash variant="micro" class="pencil-square">
                                </flux:icon.trash> Delete
                            </flux:action-a>
                        </form>
                    </div>
                </div>
                <div class=" px-4 pt-2">Order : {{ $item->order }} </div>
                <div class="p-4 pt-2">{{ $item->answer }} </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layouts.admin>
