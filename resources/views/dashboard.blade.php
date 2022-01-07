<x-app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row">
                {{-- メニューエリア --}}
                <div class="bg-white rounded-lg order-2 w-11/12 sm:w-80 mx-auto my-3 sm:m-5 p-3 shadow-lg">
                    {{-- ノート新規作成ボタン --}}
                    <form action="/" method="POST">
                        @csrf
                        <button class="block w-full bg-gray-500 text-white rounded font-bold text-xl mb-5" type="submit">+</button>
                    </form>
                    {{-- ノートブック --}}
                    @foreach ($notes as $note)
                        <div class="ml-3 mb-2">
                            <h2 class="font-bold text-lg">{{$note->note_title}}</h2>
                            <div class="flex flex-col ml-2">
                                @foreach ($note->pages as $page)
                                    <a class="truncate" href=" {{route('page.show', $page->id)}} ">{{$page->page_title}}</a>
                                @endforeach
                                {{-- ページ新規作成ボタン --}}
                               <a class="truncate text-gray-300" href="/">＜新規作成＞</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ページエリア --}}
                <div class="flex flex-col order-1 sm:order-2 w-11/12 sm:w-full my-3 sm:my-5 mx-auto sm:mr-5">
                    {{-- ボタンエリア --}}
                    <div class="flex items-center">
                        @isset($contents->id)
                            <form action=" {{route('page.update', $contents->id)}} " method="POST" id="update_form">
                                @csrf
                                @method('PATCH')
                                <button class="bg-blue-500 text-white rounded text-sm font-bold px-3 py-1 shadow-lg mb-3" type="submit">更新</button>
                            </form>
                        @endisset
                        @if(session('message')) <p class="ml-3">{{ session('message') }}</p> @endif
                    </div>
                    {{-- テキストエリア --}}
                    <textarea class="bg-white h-80 sm:h-full rounded-lg p-3 resize-none border-none shadow-lg" name="content" placeholder="Please input text content." form="update_form">@isset($contents){{$contents->page_contents}}@endisset</textarea>
                </div>
            </div>
        </div>
</x-app-layout>
