<div>


    <div class="ideas-container space-y-6 my-8">
        @forelse ($ideas as $idea)
            <livewire:idea-index
                :key="$idea->id"
                :idea="$idea"
                :votesCount="$idea->votes_count"
            />
        @empty
            <div class="mx-auto w-70 mt-12">
                <img src="{{ asset('img/Oops.jpg') }}" alt="No Ideas" class="mx-auto mix-blend-luminosity">
                <div class="text-gray-400 text-center font-bold mt-6">Keine Beiträge </div>
            </div>
        @endforelse
    </div> <!-- end ideas-container -->

    <div class="my-8">
        {{ $ideas->links() }}
    </div>
</div>
