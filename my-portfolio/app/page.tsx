// src/app/page.tsx

export default function HomePage() {
  return (
    <main className="min-h-screen bg-white text-black px-6 py-12">
      <h1 className="text-4xl font-bold mb-8">The Pool Collective</h1>
      <p className="mb-16 max-w-xl">
        A curated selection of visual storytellers—photographers, filmmakers, and creatives shaping visual culture.
      </p>

      <section className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {[...Array(6)].map((_, i) => (
          <div
            key={i}
            className="aspect-video bg-gray-200 rounded-xl flex items-center justify-center text-sm text-gray-500"
          >
            Placeholder {i + 1}
          </div>
        ))}
      </section>

      <section className="mt-24 max-w-2xl">
        <h2 className="text-2xl font-semibold mb-4">About</h2>
        <p className="text-gray-600">
          The Pool Collective is a creative production company working with world-class talent. We produce work that’s
          visually striking, emotionally engaging, and culturally relevant.
        </p>
      </section>
    </main>
  )
}