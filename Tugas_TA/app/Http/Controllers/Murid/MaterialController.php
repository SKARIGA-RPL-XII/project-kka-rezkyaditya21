<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function show($id)
    {
        $material = Material::findOrFail($id);
        return view('murid.materi.show', compact('material'));
    }

    public function video($id)
    {
        $material = Material::findOrFail($id);
        return view('murid.materi.video', compact('material'));
    }

    public function flowchart($id)
    {
        $material = Material::findOrFail($id);
        return view('murid.materi.flowchart', compact('material'));
    }

    public function compiler($id)
    {
        $material = Material::findOrFail($id);
        // Ensure we have some default code if null
        if (!$material->sample_code) {
            $material->sample_code = $this->getDefaultCode($material->language);
        }
        return view('murid.materi.compiler', compact('material'));
    }

    private function getDefaultCode($lang)
    {
        return match($lang) {
            'html' => "<!DOCTYPE html>\n<html>\n<body>\n\n<h1>Halo Dunia</h1>\n<p>Selamat belajar pemrograman!</p>\n\n</body>\n</html>",
            'python' => "print('Halo dari Python!')",
            'php' => "<?php\necho 'Halo dari PHP!';",
            'java' => "public class Main {\n    public static void main(String[] args) {\n        System.out.println(\"Halo dari Java!\");\n    }\n}",
            'csharp' => "using System;\n\nclass Program {\n    static void Main() {\n        Console.WriteLine(\"Halo dari C#!\");\n    }\n}",
            'go' => "package main\nimport \"fmt\"\n\nfunc main() {\n    fmt.Println(\"Halo dari Go!\")\n}",
            'rust' => "fn main() {\n    println!(\"Halo dari Rust!\");\n}",
            'kotlin' => "fun main() {\n    println(\"Halo dari Kotlin!\")\n}",
            'swift' => "print(\"Halo dari Swift!\")",
            'typescript' => "const message: string = \"Halo dari TypeScript!\";\nconsole.log(message);",
            'ruby' => "puts 'Halo dari Ruby!'",
            default => "// Mulai koding di sini...",
        };
    }

    public function run(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'language' => 'required|string',
        ]);

        $code = $request->code;
        $language = $request->language;

        // For web tech, we handle it on frontend usually, but if called, return success
        if (in_array($language, ['html', 'css', 'javascript_web'])) {
            return response()->json(['output' => 'Ready to preview.']);
        }

        // Mapping to Wandbox API compilers
        $langMap = [
            'python' => 'cpython-3.14.0',
            'php' => 'php-8.3.12',
            'javascript' => 'nodejs-20.17.0',
            'typescript' => 'typescript-5.6.2',
            'java' => 'openjdk-jdk-22+36',
            'csharp' => 'mono-6.12.0.199',
            'c' => 'gcc-head-c',
            'cpp' => 'gcc-head',
            'go' => 'go-1.23.2',
            'rust' => 'rust-1.82.0',
            'swift' => 'swift-6.0.1',
            'ruby' => 'ruby-4.0.2',
        ];

        $compiler = $langMap[$language] ?? null;

        if (!$compiler) {
            return response()->json([
                'output' => "Execution Error: Language '$language' is currently not supported by our execution engine.",
            ]);
        }

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://wandbox.org/api/compile.json', [
                'json' => [
                    'compiler' => $compiler,
                    'code' => $code,
                    'save' => false
                ]
            ]);

            $result = json_decode($response->getBody(), true);
            $output = $result['program_message'] ?? $result['compiler_message'] ?? $result['program_output'] ?? 'No output captured.';
            
            return response()->json([
                'output' => $output,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'output' => 'Execution Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
