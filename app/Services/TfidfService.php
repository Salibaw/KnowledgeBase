<?php

namespace App\Services;

class TfidfService
{
    // Daftar kata sambung yang harus dibuang (Stopwords Bahasa Indonesia)
    protected $stopwords = ['yang', 'di', 'dan', 'itu', 'ini', 'untuk', 'ada', 'adalah', 'ke', 'saya'];

    public function preprocess($text)
    {
        // 1. Case Folding: Kecilkan semua huruf
        $text = strtolower($text);
        
        // 2. Cleaning: Hapus tanda baca dan angka
        $text = preg_replace('/[^a-z\s]/', '', $text);
        
        // 3. Tokenizing & Filtering: Potong jadi kata & hapus kata sambung
        $words = explode(' ', $text);
        $cleanWords = array_diff($words, $this->stopwords);
        
        return array_filter($cleanWords);
    }

    public function calculateSimilarity($query, $documents)
    {
        // Di sini nanti rumus matematika TF-IDF dan Cosine Similarity dijalankan
        // Query: Keluhan User sekarang
        // Documents: Semua solusi yang ada di Knowledge Base
        
        $results = [];
        $queryWords = $this->preprocess($query);

        foreach ($documents as $doc) {
            $docWords = $this->preprocess($doc->problem_title . ' ' . $doc->problem_description);
            
            // Hitung kata yang sama (Logika sederhana awal)
            $intersect = array_intersect($queryWords, $docWords);
            $score = count($intersect); // Semakin banyak kata sama, skor makin tinggi

            if ($score > 0) {
                $results[] = [
                    'score' => $score,
                    'data' => $doc
                ];
            }
        }

        // Urutkan dari skor tertinggi
        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);
        
        return $results;
    }
}